<?php

namespace App\Http\Controllers;

use App\Project;
use App\ProjectStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
	public function __construct()
	{
		//$this->middleware( 'auth' );
	}
	public function show($id = null)
	{
		$project = $id ? Project::findOrNew($id) : null;
		return view('project', [
				'projects'				=> Project::orderBy('updated_at', 'desc')->get(),
				'projectStatusList'		=> ProjectStatus::orderBy('created_at', 'asc')->get(),
				'statusOptions'			=> $this->_getStatusOptions(),
				'project'				=> $project
		]);
	}
	
	public function addNew(Request $request)
	{
		$this->_validateForm($request);
		
		$project = new Project;
		$this->_upsert($request, $project);
		
		return redirect( '/' );
	}
	
	public function update(Request $request, $id)
	{
		$this->_validateForm($request);
		
		$project = Project::findOrNew($id);
		$this->_upsert($request, $project);
		
		return redirect( '/' );
	}
	
	public function delete($id)
	{
		$project = Project::findOrNew($id);
		if ($project) {
			$project->delete();
		}
		
		return redirect( '/' );
	}
	
	private function _upsert(Request $request, Project $project)
	{
		if ($project) {
			$project->name = $request->name;
			$project->description = $request->description;
			$project->project_status_id = $request->project_status_id;
			$project->closed_at = $request->closed_at;
			$project->started_at = $request->started_at;
			$project->ended_at = $request->ended_at;
			$project->save();
		}
	}
	
	private function _validateForm(Request $request)
	{
		$this->validate( $request, [
				'name'					=> 'required|max:255',
				//'description'			=> 'required',
				'project_status_id'		=> 'required',
				//'closed_at'				=> 'required',
				//'started_at'			=> 'required',
				//'ended_at'				=> 'required'
		] );
	}
	
	private function _getStatusOptions()
	{
		$statusOptions = [];
		$ProjectStatusList = ProjectStatus::orderBy('created_at', 'asc')->get();
		foreach ($ProjectStatusList as $ProjectStatus) {
			if ($ProjectStatus->id) {
				$statusOptions[$ProjectStatus->id] = $ProjectStatus->name;
			}
		}
		return $statusOptions;
	}
}
