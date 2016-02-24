<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\TaskStatus;
use App\Project;

class TaskController extends Controller
{

	public function __construct()
	{
		//$this->middleware( 'auth' );
	}
	
	public function show(Request $request, $id = null)
	{
		$task = $id ? Task::findOrNew($id) : null;
		$tasks = $request->user() ? Task::where('user_id', $request->user()->id)->orderBy('updated_at', 'desc')->get() : Task::orderBy('updated_at', 'desc')->get();
		return view('task', [
				'task'				=> $task,
				'tasks'				=> $tasks,
				'statusOptions'		=> $this->_getStatusOptions(),
				'projectOptions'	=> $this->_getProjectOptions(),
				'projects'			=> Project::orderBy('updated_at', 'desc')->get(),
				'taskStatusList'	=> TaskStatus::orderBy('updated_at', 'desc')->get()
		]);
	}
	
	public function addNew(Request $request)
	{
		$this->_validateForm($request);
		$task = new Task();
		$this->_upsert($request, $task);
		
		return redirect( '/task' );
	}
	
	public function update(Request $request, $id)
	{
		$this->_validateForm($request);
		$task = Task::findOrNew($id);
		$this->_upsert($request, $task);
		
		return redirect( '/task' );
	}
	
	public function delete($id)
	{
		$task = Task::findOrNew($id);
		if ($task) {
			$task->delete();
		}
		
		return redirect( '/task' );
	}
	
	private function _upsert(Request $request, Task $task)
	{
		if ($task) {
			$task->name = $request->name;
			$task->description = $request->description;
			$task->task_status_id = $request->task_status_id;
			$task->project_id = $request->project_id;
			$task->closed_at = $request->closed_at;
			$request->user()->tasks()->save($task);
		}
	}
	
	private function _validateForm(Request $request)
	{
		$this->validate( $request, [
				'name'				=> 'required|max:255',
				'task_status_id'	=> 'required',
				'project_id'		=> 'required'
		] );
	}
	
	private function _getProjectOptions()
	{
		$projectOptions = [];
		$projects = Project::orderBy('updated_at', 'desc')->get();
		foreach ($projects as $project) {
			if ($project->id) {
				$projectOptions[$project->id] = $project->name;
			}
		}
		return $projectOptions;
	}
	
	private function _getStatusOptions()
	{
		$statusOptions = [];
		$taskStatusList = TaskStatus::orderBy('updated_at', 'desc')->get();
		foreach ($taskStatusList as $taskStatus) {
			if ($taskStatus->id) {
				$statusOptions[$taskStatus->id] = $taskStatus->name;
			}
		}
		return $statusOptions;
	}
}
