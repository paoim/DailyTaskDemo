<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\TaskStatusRepository;

class TaskStatusController extends Controller
{
	protected $taskStatus;
	
	public function __construct(TaskStatusRepository $taskStatus)
	{
		//$this->middleware( 'auth' );
		$this->taskStatus = $taskStatus;
	}
	
	public function show($id = null)
	{
		$taskStatus = $id ? $this->taskStatus->get($id) : null;
		return view('taskStatus', [
				'taskStatus'		=> $taskStatus,
				'taskStatusList'	=> $this->taskStatus->getAll(),
				'options'			=> $this->taskStatus->getOptions()
		]);
	}
	
	public function addNew(Request $request)
	{
		$this->_validateForm($request);
		$this->taskStatus->upsert($request);
		
		return redirect( '/taskStatus' );
	}
	
	public function update(Request $request, $id)
	{
		$this->_validateForm($request);
		$this->taskStatus->upsert($request, $id);
		
		return redirect( '/taskStatus' );
	}
	
	public function delete($id)
	{
		$this->taskStatus->delete($id);
		
		return redirect( '/taskStatus' );
	}
	
	private function _validateForm(Request $request)
	{
		$this->validate( $request, [
				'name'		=> 'required|max:255',
				'active'	=> 'required'
		]);
	}
}
