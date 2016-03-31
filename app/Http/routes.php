<?php


Route::get('/', 'ProjectController@index');


Route::group(['middleware' => 'web'], function () {
	Route::auth();

	Route::get('/', 'ProjectController@index');
	Route::get('/new', 'ProjectController@create');
	Route::get('/edit/{id}', 'ProjectController@edit');
	Route::get('/detail/{id}', 'ProjectController@show');

	Route::post('/store', 'ProjectController@store');
	Route::post('/update/{id}', 'ProjectController@update');
	Route::delete('/delete/{id}', 'ProjectController@destroy');

	Route::get('/task', 'TaskController@index');
	Route::get('/task/new', 'TaskController@create');
	Route::get('/task/edit/{id}', 'TaskController@edit');
	Route::get('/task/detail/{id}', 'TaskController@show');

	Route::post('/task/store', 'TaskController@store');
	Route::post('/task/update/{id}', 'TaskController@update');
	Route::delete('/task/delete/{id}', 'TaskController@destroy');

	Route::get('/taskStatus', 'TaskStatusController@index');
	Route::get('/taskStatus/new', 'TaskStatusController@create');
	Route::get('/taskStatus/edit/{id}', 'TaskStatusController@edit');
	Route::get('/taskStatus/detail/{id}', 'TaskStatusController@show');

	Route::post('/taskStatus/store', 'TaskStatusController@store');
	Route::post('/taskStatus/update/{id}', 'TaskStatusController@update');
	Route::delete('/taskStatus/delete/{id}', 'TaskStatusController@destroy');

	Route::get('/projectStatus', 'ProjectStatusController@index');
	Route::get('/projectStatus/new', 'ProjectStatusController@create');
	Route::get('/projectStatus/edit/{id}', 'ProjectStatusController@edit');
	Route::get('/projectStatus/detail/{id}', 'ProjectStatusController@show');

	Route::post('/projectStatus/store', 'ProjectStatusController@store');
	Route::post('/projectStatus/update/{id}', 'ProjectStatusController@update');
	Route::delete('/projectStatus/delete/{id}', 'ProjectStatusController@destroy');
});

