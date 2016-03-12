<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectStatus extends Model
{
	protected $table = 'project_status';
	
	protected $fillable = ['name', 'active', 'abv'];
	
	public function projects()
	{
		return $this->hasMany(Project::class);
	}
}
