<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\TaskRepository;
use App\Repositories\ProjectRepository;
use App\Repositories\TaskStatusRepository;

class TaskController extends Controller
{
	protected $task;
	protected $project;
	protected $taskStatus;

	public function __construct(TaskRepository $task, TaskStatusRepository $taskStatus, ProjectRepository $project)
	{
		//$this->middleware( 'auth' );
		$this->task = $task;
		$this->project = $project;
		$this->taskStatus = $taskStatus;
	}
	
	public function index(Request $request)
	{
		$tasks = $request->user() ? $this->task->forUser($request->user()) : $this->task->getAll();
		return view('task', [
				'Tasks'				=> $tasks,
				'projectOptions'	=> $this->project->getProjectOptions(),
				'statusOptions'		=> $this->taskStatus->getStatusOptions()
		]);
	}
	
	public function create()
	{
		return view('layouts.task.create', [
				'Projects'			=> $this->project->getProjects(),
				'TaskStatusList'	=> $this->taskStatus->getTaskStatusList()
		]);
	}
	
	public function store(Request $request)
	{
		$this->_validateForm($request);
		$this->task->upsert($request);
		
		return redirect( '/task' );
	}
	
	public function show($id)
	{
		return view('layouts.task.detail', [
				'Task'				=> $this->task->get($id),
				'projectOptions'	=> $this->project->getProjectOptions(),
				'statusOptions'		=> $this->taskStatus->getStatusOptions()
		]);
	}
	
	public function edit($id)
	{
		return view('layouts.task.edit', [
				'Task'				=> $this->task->get($id),
				'Projects'			=> $this->project->getProjects(),
				'TaskStatusList'	=> $this->taskStatus->getTaskStatusList()
		]);
	}
	
	public function update(Request $request, $id)
	{
		$this->_validateForm($request);
		$this->task->upsert($request, $id);
		
		return redirect('/task');
	}
	
	public function destroy($id)
	{
		$this->task->delete($id);
		
		return redirect('/task');
	}
	
	private function _validateForm(Request $request)
	{
		$this->validate( $request, [
				'name'				=> 'required|max:255',
				'task_status_id'	=> 'required',
				'project_id'		=> 'required'
		] );
	}
}
