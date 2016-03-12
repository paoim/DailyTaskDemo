<?php

namespace App\Repositories;

use App\ProjectStatus;
use Illuminate\Http\Request;

class ProjectStatusRepository
{
	public function get($id)
	{
		return ProjectStatus::findOrNew($id);
	}
	
	public function getAll()
	{
		return ProjectStatus::orderBy('created_at', 'asc')->get();
	}
	
	public function create(Request $request)
	{
		ProjectStatus::create([
				'name'		=> $request->name,
				'active'	=> $request->active,
				'abv'		=> $request->abv
		]);
	}
	
	public function update(Request $request, $id)
	{
		$projectStatus = $this->get($id);
		if ($projectStatus) {
			$projectStatus->name = $request->name;
			$projectStatus->active = $request->active;
			$projectStatus->abv = $request->abv;
			$projectStatus->save();
		}
	}
	
	public function delete($id)
	{
		$projectStatus = $this->get($id);
		if ($projectStatus) {
			$projectStatus->delete();
		}
	}
	
	public function getOptions()
	{
		$options = ['0' => 'In-Active', '1' => 'active'];
		return $options;
	}
}
