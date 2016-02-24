<?php


Route::get('/', 'ProjectController@show');


Route::group(['middleware' => 'web'], function () {
	Route::auth();

	Route::get('/', 'ProjectController@show');
	Route::get('/detail/{id}', 'ProjectController@show');
	
	Route::post('/new', 'ProjectController@addNew');
	Route::post('/update/{id}', 'ProjectController@update');
	Route::delete('/delete/{id}', 'ProjectController@delete');
	
	Route::get('/task', 'TaskController@show');
	Route::get('/task/{id}', 'TaskController@show');
	
	Route::post('/task/new', 'TaskController@addNew');
	Route::post('/task/update/{id}', 'TaskController@update');
	Route::delete('/task/delete/{id}', 'TaskController@delete');
	
	Route::get('/taskStatus', 'TaskStatusController@show');
	Route::get('/taskStatus/{id}', 'TaskStatusController@show');
	
	Route::post('/taskStatus/new', 'TaskStatusController@addNew');
	Route::post('/taskStatus/update/{id}', 'TaskStatusController@update');
	Route::delete('/taskStatus/delete/{id}', 'TaskStatusController@delete');
	
	Route::get('/projectStatus', 'ProjectStatusController@show');
	Route::get('/projectStatus/{id}', 'ProjectStatusController@show');
	
	Route::post('/projectStatus/new', 'ProjectStatusController@addNew');
	Route::post('/projectStatus/update/{id}', 'ProjectStatusController@update');
	Route::delete('/projectStatus/delete/{id}', 'ProjectStatusController@delete');
});
