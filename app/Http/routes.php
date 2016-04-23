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
	
	Route::post('user/search/modal', 'UserController@searchUserModal');
	Route::post('user/search/list', 'UserController@searchUserList');
	//User Projects
	Route::get('user/projects', 'ProjectController@projects');
	Route::get('user/profile/{userid?}/projects', 'ProjectController@projects');
	//Projects
	Route::get('projects', 'ProjectController@projects');
	//Project
	Route::get('projects/{slug?}', 'ProjectController@project');
	
	//Edit routes
	Route::group(['middleware' => ['auth']], function () {
		Route::get('project/add', 'ProjectController@add');
		Route::get('project/edit/{id?}', 'ProjectController@edit');
		
		Route::post('project/postnext', 'ProjectController@postNext');
		//Goal
		Route::post('project/add/goalmodal', 'ProjectController@addGoalModal');
		Route::post('project/add/goal', 'ProjectController@addGoal');
		Route::post('project/remove/goal', 'ProjectController@removeGoal');
		//Reward
		Route::post('project/add/rewardmodal', 'ProjectController@addRewardModal');
		Route::post('project/add/reward', 'ProjectController@addReward');
		Route::post('project/remove/reward', 'ProjectController@removeReward');
	});
	//Forgot Password
	Route::get('user/reset/password', 'Auth\PasswordController@getEmail');
	Route::post('user/reset/password', 'Auth\PasswordController@postEmail');
	
	
	Route::post('project/upload/image', function(){
		$options['upload_url'] = url('/images/projects/');
		$options['upload_dir'] = public_path().'/images/projects/';
		$upload_handler = new App\Http\Controllers\UploadController($options);
	});

	Route::post('project/upload/reward', function(){
		$options['upload_url'] = url('/images/rewards/');
		$options['upload_dir'] = public_path().'/images/rewards/';
		$upload_handler = new App\Http\Controllers\UploadController($options);
	});
	
	Route::group(['prefix' => 'admin','middleware' => ['auth', 'admin']], function () {
		// Categories
		Route::get('categories/create', 'CategoryController@create');
		Route::get('categories/edit/{id?}', 'CategoryController@create');
		Route::post('categories/store', 'CategoryController@store');
		Route::post('categories/update', 'CategoryController@update');
		Route::get('categories/{type?}', 'CategoryController@index');
		// Contents
		Route::get('content/create', 'ContentController@create');
		Route::get('content/edit/{id?}', 'ContentController@create');
		Route::post('content/store', 'ContentController@store');
		Route::post('content/update', 'ContentController@update');
		Route::get('content/{type?}', 'ContentController@index');
	});
});