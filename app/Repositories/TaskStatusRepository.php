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
	
	public function getAll()
	{
		return TaskStatus::orderBy('created_at', 'asc')->get();
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
}