<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ProjectStatusRepository;

class ProjectStatusController extends Controller
{
	protected $projectStatus;
	
	public function __construct(ProjectStatusRepository $projectStatus)
	{
		//$this->middleware( 'auth' );
		$this->projectStatus = $projectStatus;
	}
	
	public function show($id = null)
	{
		$projectStatus = $id ? $this->projectStatus->get($id) : null;
		return view('projectStatus', [
				'projectStatus'			=> $projectStatus,
				'projectStatusList'		=> $this->projectStatus->getAll(),
				'options'				=> $this->projectStatus->getOptions()
		]);
	}
	
	public function addNew(Request $request)
	{
		$this->_validateForm($request);
		
		$this->projectStatus->upsert($request);
		
		return redirect( '/projectStatus' );
	}
	
	public function update(Request $request, $id)
	{
		$this->_validateForm($request);
		
		$this->projectStatus->upsert($request, $id);
		
		return redirect( '/projectStatus' );
	}
	
	public function delete($id)
	{
		$this->projectStatus->delete($id);
		
		return redirect( '/projectStatus' );
	}
	
	private function _validateForm(Request $request)
	{
		$this->validate( $request, [
				'name'		=> 'required|max:255',
				'active'	=> 'required',
				'abv'		=> 'required|max:15'
		] );
	}
}
