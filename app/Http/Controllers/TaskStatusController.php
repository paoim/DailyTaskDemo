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
	
	public function index()
	{
		return view('taskStatus', [
				'options'			=> $this->taskStatus->getOptions(),
				'TaskStatusList'	=> $this->taskStatus->paginatePages()
		]);
	}
	
	public function create()
	{
		return view('layouts.taskStatus.create', ['options' => $this->taskStatus->getOptions()]);
	}
	
	public function store(Request $request)
	{
		$this->_validateForm($request);
		$this->taskStatus->upsert($request);
		
		return redirect( '/taskStatus' );
	}
	
	public function show($id)
	{
		return view('layouts.taskStatus.detail', ['options' => $this->taskStatus->getOptions()])->with('TaskStatus', $this->taskStatus->get($id));
	}
	
	public function update(Request $request, $id)
	{
		$this->_validateForm($request);
		$this->taskStatus->upsert($request, $id);
		
		return redirect( '/taskStatus' );
	}
	
	public function edit($id)
	{
		return view('layouts.taskStatus.edit', ['options' => $this->taskStatus->getOptions()])->with('TaskStatus', $this->taskStatus->get($id));
	}
	
	public function destroy($id)
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
