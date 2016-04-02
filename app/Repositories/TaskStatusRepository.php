<?php

namespace App\Repositories;

use App\TaskStatus;
use Illuminate\Http\Request;

class TaskStatusRepository
{
	public function get($id)
	{
		return TaskStatus::findOrNew($id);
	}
	
	public function paginatePages($numberPerPage = 10)
	{
		return TaskStatus::paginate($numberPerPage);
	}
	
	public function getAll($field = 'updated_at', $orderBy = 'desc')
	{
		return TaskStatus::orderBy($field, $orderBy)->get();
	}
	
	public function upsert(Request $request, $id = null)
	{
		$taskStatus = $id ? $this->get($id) : new TaskStatus();
		if ($taskStatus) {
			$taskStatus->name = $request->name;
			$taskStatus->active = $request->active;
			$taskStatus->save();
		}
	}
	
	public function create(Request $request)
	{
		TaskStatus::create([
				'name'		=> $request->name,
				'active'	=> $request->active
		]);
	}
	
	public function update(Request $request, $id)
	{
		$taskStatus = $this->get($id);
		if ($taskStatus) {
			$taskStatus->name = $request->name;
			$taskStatus->active = $request->active;
			$taskStatus->save();
		}
	}
	
	public function delete($id)
	{
		$taskStatus = $this->get($id);
		if ($taskStatus) {
			$taskStatus->delete();
		}
	}
	
	public function getOptions()
	{
		$options = ['0' => 'In-Active', '1' => 'active'];
		return $options;
	}
	
	public function getTaskStatusList()
	{
		return $this->getAll('created_at', 'asc');
	}
	
	public function getStatusOptions()
	{
		$statusOptions = [];
		$taskStatusList = $this->getTaskStatusList();
		foreach ($taskStatusList as $taskStatus) {
			if ($taskStatus->id) {
				$statusOptions[$taskStatus->id] = $taskStatus->name;
			}
		}
		return $statusOptions;
	}
}
