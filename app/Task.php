<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
	protected $table = 'tasks';
	
	protected $fillable = ['name', 'description', 'closed_at', 'project_id', 'task_status_id'];
	
	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
