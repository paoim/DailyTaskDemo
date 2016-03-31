<?php

namespace App;

use Carbon;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
	protected $table = 'projects';
	
	protected $fillable = ['name', 'description', 'project_status_id', 'closed_at', 'started_at', 'ended_at'];
	
	public function setClosedAtAttribute($date)
	{
		$this->attributes['closed_at'] = Carbon\Carbon::createFromFormat('Y-m-d', $date);
	}
	
	public function setStartedAtAttribute($date)
	{
		$this->attributes['started_at'] = Carbon\Carbon::createFromFormat('Y-m-d', $date);
	}
	
	public function setEndedAtAttribute($date)
	{
		$this->attributes['ended_at'] = Carbon\Carbon::createFromFormat('Y-m-d', $date);
	}
	
	public function getClosedAtAttribute()
	{
		return Carbon\Carbon::parse($this->attributes['closed_at']);
	}
	
	public function getEndedAtAttribute()
	{
		return Carbon\Carbon::parse($this->attributes['ended_at']);
	}
	
	public function tasks()
	{
		return $this->hasMany(Task::class);
	}
	
	public function projectStatus()
	{
		return $this->belongsTo(ProjectStatus::class);
	}
}
