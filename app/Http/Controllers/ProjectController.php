<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ProjectRepository;
use App\Repositories\ProjectStatusRepository;

class ProjectController extends Controller
{
	protected $project;
	protected $projectStatus;
	
	public function __construct(ProjectRepository $project, ProjectStatusRepository $projectStatus)
	{
		//$this->middleware( 'auth' );
		$this->project = $project;
		$this->projectStatus = $projectStatus;
	}
	public function show($id = null)
	{
		$project = $id ? $this->project->get($id) : null;
		return view('project', [
				'project'				=> $project,
				'projects'				=> $this->project->getAll(),
				'projectStatusList'		=> $this->projectStatus->getProjectStatusList(),
				'statusOptions'			=> $this->projectStatus->getProjectStatusOptions()
		]);
	}
	
	public function addNew(Request $request)
	{
		$this->_validateForm($request);
		
		$this->project->upsert($request);
		
		return redirect( '/' );
	}
	
	public function update(Request $request, $id)
	{
		$this->_validateForm($request);
		
		$this->project->upsert($request, $id);
		
		return redirect( '/' );
	}
	
	public function delete($id)
	{
		$this->project->delete($id);
		
		return redirect( '/' );
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
}
