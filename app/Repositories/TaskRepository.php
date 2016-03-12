<?php

namespace App\Repositories;

use App\User;
use App\Task;
use App\Project;
use App\TaskStatus;
use Illuminate\Http\Request;

class TaskRepository
{
	public function get($id)
	{
		//return Task::where('id', $id)->get();
		return Task::findOrNew($id);
	}
	
	public function getAll()
	{
		return Task::all();
		//return Task::orderBy('created_at', 'asc')->get();
	}
	
	public function forUser(User $user)
	{
		return Task::where('user_id', $user->id)->orderBy('created_at', 'asc')->get();
	}
	
	public function forProject(Project $project)
	{
		return Task::where('project_id', $project->id)->orderBy('created_at', 'asc')->get();
	}
	
	public function forTaskStatus(TaskStatus $taskStatus)
	{
		return Task::where('task_status_id', $taskStatus->id)->orderBy('created_at', 'asc')->get();
	}
	
	public function create(Request $request)
	{
		Task::create([
				'name'				=> $request->name,
				'description'		=> $request->description,
				'user_id'			=> $request->user_id,
				'task_status_id'	=> $request->task_status_id,
				'project_id'		=> $request->project_id,
				'closed_at'			=> $request->closed_at
		]);
	}
	
	public function update(Request $request, $id)
	{
		$task = $this->get($id);
		if ($task) {
			$task->name = $request->name;
			$task->description = $request->description;
			$task->task_status_id = $request->task_status_id;
			$task->project_id = $request->project_id;
			$task->closed_at = $request->closed_at;
			$task->save();
		}
	}
	
	public function delete($id)
	{
		$task = $this->get($id);
		if ($task) {
			$task->delete();
		}
	}
}
