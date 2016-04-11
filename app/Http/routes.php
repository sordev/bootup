<?php
//Home Route


//Starting 5.2 web middleware has to be included
Route::group(['middleware' => ['web']], function () {
	Route::get('/', 'HomeController@index');
	
	//User Route
	Route::match(['get', 'post'], '/user/login/{provider?}', 'UserController@login');
	Route::get('user/register', 'UserController@create');
	Route::get('user/logout', 'UserController@logout');
	Route::post('user/store', 'UserController@store');
	Route::get('user/profile/{id?}', 'UserController@profile');
	Route::get('user/edit/profile/password', 'UserController@editPassword');
	Route::post('user/update/profile/password', 'UserController@updatePassword');
	//User Projects
	Route::get('user/projects', 'ProjectController@projects');
	Route::get('user/profile/{userid?}/projects', 'ProjectController@projects');
	//Projects
	Route::get('projects', 'ProjectController@projects');
	Route::get('projects/add', 'ProjectController@add');
	Route::post('projects/postnext', 'ProjectController@postNext');
	//Project
	Route::get('project/{slug?}', 'ProjectController@project');
	//Edit routes
	Route::group(['middleware' => ['auth']], function () {
		Route::get('edit/project/{id?}', 'ProjectController@edit');
	});
	//Forgot Password
	Route::get('user/reset/password', 'Auth\PasswordController@getEmail');
	Route::post('user/reset/password', 'Auth\PasswordController@postEmail');
	
	
	Route::post('projects/upload/image', function(){
		$options['upload_url'] = url('/images/projects/');
		$options['upload_dir'] = public_path().'/images/projects/';
		$upload_handler = new App\Http\Controllers\UploadController($options);
	});
	
	Route::group(['prefix' => 'admin','middleware' => ['auth', 'admin']], function () {
		Route::get('categories/create/{id?}', 'CategoryController@create');
		Route::post('categories/store', 'CategoryController@store');
		Route::post('categories/update', 'CategoryController@update');
		Route::get('categories/{type?}', 'CategoryController@index');
	});
});