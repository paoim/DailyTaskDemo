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
	
	public function show(Request $request, $id = null)
	{
		$task = $id ? $this->task->get($id) : null;
		$tasks = $request->user() ? $this->task->forUser($request->user()) : $this->task->getAll();
		return view('task', [
				'task'				=> $task,
				'tasks'				=> $tasks,
				'projects'			=> $this->project->getProjects(),
				'projectOptions'	=> $this->project->getProjectOptions(),
				'statusOptions'		=> $this->taskStatus->getStatusOptions(),
				'taskStatusList'	=> $this->taskStatus->getTaskStatusList()
		]);
	}
	
	public function addNew(Request $request)
	{
		$this->_validateForm($request);
		$this->task->upsert($request);
		
		return redirect( '/task' );
	}
	
	public function update(Request $request, $id)
	{
		$this->_validateForm($request);
		$this->task->upsert($request, $id);
		
		return redirect('/task');
	}
	
	public function delete($id)
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
