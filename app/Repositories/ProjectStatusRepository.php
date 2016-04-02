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
	
	public function paginatePages($numberPerPage = 10)
	{
		return ProjectStatus::paginate($numberPerPage);
	}
	
	public function getAll($field = 'updated_at', $orderBy = 'desc')
	{
		return ProjectStatus::orderBy($field, $orderBy)->get();
	}
	
	public function upsert(Request $request, $id = null)
	{
		$projectStatus = $id ? $this->get($id) : new ProjectStatus();
		if ($projectStatus) {
			$projectStatus->name = $request->name;
			$projectStatus->active = $request->active;
			$projectStatus->abv = $request->abv;
			$projectStatus->save();
		}
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
	
	public function getProjectStatusList()
	{
		return $this->getAll('created_at', 'asc');
	}
	
	public function getProjectStatusOptions()
	{
		$statusOptions = [];
		$ProjectStatusList = $this->getProjectStatusList();
		foreach ($ProjectStatusList as $ProjectStatus) {
			if ($ProjectStatus->id) {
				$statusOptions[$ProjectStatus->id] = $ProjectStatus->name;
			}
		}
		return $statusOptions;
	}
}
