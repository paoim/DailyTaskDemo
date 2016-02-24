<?php

namespace App\Http\Controllers;

use App\ProjectStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectStatusController extends Controller
{
	public function __construct()
	{
		//$this->middleware( 'auth' );
	}
	
	public function show($id = null)
	{
		$projectStatus = $id ? ProjectStatus::findOrNew($id) : null;
		return view('projectStatus', [
				'projectStatusList'		=> ProjectStatus::orderBy('updated_at', 'desc')->get(),
				'projectStatus'			=> $projectStatus,
				'options'				=> $this->_getOptions()
		]);
	}
	
	public function addNew(Request $request)
	{
		$this->_validateForm($request);
		
		$projectStatus = new ProjectStatus;
		$this->_upsert($request, $projectStatus);
		
		return redirect( '/projectStatus' );
	}
	
	public function update(Request $request, $id)
	{
		$this->_validateForm($request);
		
		$projectStatus = ProjectStatus::findOrNew($id);
		$this->_upsert($request, $projectStatus);
		
		return redirect( '/projectStatus' );
	}
	
	public function delete($id)
	{
		$projectStatus = ProjectStatus::findOrNew($id);
		if ($projectStatus) {
			$projectStatus->delete();
		}
		
		return redirect( '/projectStatus' );
	}
	
	private function _upsert(Request $request, ProjectStatus $projectStatus)
	{
		if ($projectStatus) {
			$projectStatus->name = $request->name;
			$projectStatus->active = $request->active;
			$projectStatus->abv = $request->abv;
			$projectStatus->save();
		}
	}
	
	private function _validateForm(Request $request)
	{
		$this->validate( $request, [
				'name'		=> 'required|max:255',
				'active'	=> 'required',
				'abv'		=> 'required|max:15'
		] );
	}
	
	private function _getOptions()
	{
		$options = ['0' => 'In-Active', '1' => 'active'];
		return $options;
	}
}
