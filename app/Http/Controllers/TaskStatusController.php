<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\TaskStatus;

class TaskStatusController extends Controller
{
	public function __construct()
	{
		//$this->middleware( 'auth' );
	}
	
	public function show($id = null)
	{
		$taskStatus = $id ? TaskStatus::findOrNew($id) : null;
		return view('taskStatus', [
				'taskStatusList'	=> TaskStatus::orderBy('updated_at', 'desc')->get(),
				'options'			=> $this->_getOptions(),
				'taskStatus'		=> $taskStatus
		]);
	}
	
	public function addNew(Request $request)
	{
		$this->_validateForm($request);
		
		$taskStatus = new TaskStatus();
		$this->_upsert($request, $taskStatus);
		
		return redirect( '/taskStatus' );
	}
	
	public function update(Request $request, $id)
	{
		$this->_validateForm($request);
		
		$taskStatus = TaskStatus::findOrNew($id);
		$this->_upsert($request, $taskStatus);
		
		return redirect( '/taskStatus' );
	}
	
	public function delete($id)
	{
		$taskStatus = TaskStatus::findOrNew($id);
		if ($taskStatus) {
			$taskStatus->delete();
		}
		
		return redirect( '/taskStatus' );
	}
	
	private function _upsert(Request $request, TaskStatus $taskStatus)
	{
		if ($taskStatus) {
			$taskStatus->name = $request->name;
			$taskStatus->active = $request->active;
			$taskStatus->save();
		}
	}
	
	private function _validateForm(Request $request)
	{
		$this->validate( $request, [
				'name'		=> 'required|max:255',
				'active'	=> 'required'
		] );
	}
	
	private function _getOptions()
	{
		$options = ['0' => 'In-Active', '1' => 'active'];
		return $options;
	}
}
