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
	
	public function index()
	{
		return view('project', [
				'Projects'			=> $this->project->paginatePages(),
				'statusOptions'		=> $this->projectStatus->getProjectStatusOptions()
		]);
	}
	
	public function create()
	{
		return view('layouts.project.create', ['ProjectStatusList' => $this->projectStatus->getProjectStatusList()]);
	}
	
	public function store(Request $request)
	{
		$this->_validateForm($request);
		
		$this->project->upsert($request);
		
		return redirect( '/' );
	}
	
	public function show($id)
	{
		return view('layouts.project.detail', [
				'Project'			=> $this->project->get($id),
				'statusOptions'		=> $this->projectStatus->getProjectStatusOptions()
		]);
	}
	
	public function edit($id)
	{
		return view('layouts.project.edit', [
				'Project'				=> $this->project->get($id),
				'ProjectStatusList'		=> $this->projectStatus->getProjectStatusList()
		]);
	}
	
	public function update(Request $request, $id)
	{
		$this->_validateForm($request);
		
		$this->project->upsert($request, $id);
		
		return redirect( '/' );
	}
	
	public function destroy($id)
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
