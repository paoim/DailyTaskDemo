<?php

namespace App\Repositories;

use App\Project;
use App\ProjectStatus;
use Illuminate\Http\Request;

class ProjectRepository
{
	public function get($id)
	{
		return Project::findOrNew($id);
	}
	
	public function getAll($field = 'updated_at', $orderBy = 'desc')
	{
		return Project::orderBy($field, $orderBy)->get();
	}
	
	public function forProjectStatus(ProjectStatus $projectStatus)
	{
		return Task::where('project_status_id', $projectStatus->id)->orderBy('created_at', 'asc')->get();
	}
	
	public function upsert(Request $request, $id = null)
	{
		$project = $id ? $this->get($id) : new Project();
		if ($project) {
			$project->name = $request->name;
			$project->description = $request->description;
			$project->project_status_id = $request->project_status_id;
			$project->closed_at = $request->closed_at;
			$project->started_at = $request->started_at;
			$project->ended_at = $request->ended_at;
			$project->save();
		}
	}
	
	public function create(Request $request)
	{
		Project::create([
				'name'					=> $request->name,
				'description'			=> $request->description,
				'project_status_id'		=> $request->project_status_id,
				'closed_at'				=> $request->closed_at,
				'started_at'			=> $request->started_at,
				'ended_at'				=> $request->ended_at
		]);
	}
	
	public function update(Request $request, $id)
	{
		$project = $this->get($id);
		if ($project) {
			$project->name = $request->name;
			$project->description = $request->description;
			$project->project_status_id = $request->project_status_id;
			$project->closed_at = $request->closed_at;
			$project->started_at = $request->started_at;
			$project->ended_at = $request->ended_at;
			$project->save();
		}
	}
	
	public function delete($id)
	{
		$project = $this->get($id);
		if ($project) {
			$project->delete();
		}
	}
}
