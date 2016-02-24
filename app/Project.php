<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
	protected $table = 'projects';
	
	protected $fillable = ['name', 'description', 'project_status_id', 'closed_at', 'started_at', 'ended_at'];
}
