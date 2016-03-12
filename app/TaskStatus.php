<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskStatus extends Model
{
	protected $table = 'task_status';
	
	protected $fillable = ['name', 'active'];
	
	public function tasks()
	{
		return $this->hasMany(Task::class);
	}
}
