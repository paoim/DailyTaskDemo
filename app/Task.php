<?php

namespace App;

use Carbon;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
	protected $table = 'tasks';
	
	protected $fillable = ['name', 'description', 'closed_at', 'project_id', 'task_status_id'];
	
	public function setClosedAtAttribute($date)
	{
		$this->attributes['closed_at'] = Carbon\Carbon::createFromFormat('Y-m-d', $date);
	}
	
	public function getClosedAtAttribute()
	{
		return Carbon\Carbon::parse($this->attributes['closed_at']);
	}
	
	public function user()
	{
		return $this->belongsTo(User::class);
	}
	
	public function project()
	{
		return $this->belongsTo(Project::class);
	}
	
	public function taskStatus()
	{
		return $this->belongsTo(TaskStatus::class);
	}
}
