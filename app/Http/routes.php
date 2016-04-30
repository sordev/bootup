<?php
//Starting 5.2 web middleware has to be included
Route::group(['middleware' => ['web','striptags']], function () {
	//Home Route
	Route::get('/', 'HomeController@index');

	

	//User Route
	Route::match(['get', 'post'], '/user/login/{provider?}', 'UserController@login');
	Route::get('user/register', 'UserController@create');
	Route::get('user/logout', 'UserController@logout');
	Route::post('user/store', 'UserController@store');
	Route::get('user/profile/{id?}', 'UserController@profile');
	
	//Forgot Password
	Route::get('user/reset/password', 'Auth\PasswordController@getEmail');
	Route::post('user/reset/password', 'Auth\PasswordController@postEmail');
	
	Route::post('user/search/modal', 'UserController@searchUserModal');
	Route::post('user/search/list', 'UserController@searchUserList');
	//User Projects
	Route::get('user/projects', 'ProjectController@projects');
	//Projects
	Route::get('projects', 'ProjectController@projects');
	Route::get('project/category/{category?}', 'ProjectController@projects');
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
		
		//User profile edits
		Route::get('user/edit/profile', 'UserController@edit');
		Route::post('user/update/profile', 'UserController@update');
		
		Route::get('user/edit/profile/password', 'UserController@editPassword');
		Route::post('user/update/profile/password', 'UserController@updatePassword');
	});
	
	
	
	Route::post('project/upload/image', function(){
		$options['upload_url'] = url('/images/project/');
		$options['upload_dir'] = public_path().'/images/project/';
		$options['image_versions']['large'] = ['max_width'=>'1366','max_height'=>'768','crop'=>true];
		$options['image_versions']['thumbnail'] = ['max_width'=>'80','max_height'=>'80','crop'=>true];
		$options['image_versions']['medium'] = ['max_width'=>'420','max_height'=>'325','crop'=>true];
		$upload_handler = new App\Http\Controllers\UploadController($options);
	});

	Route::post('project/upload/reward', function(){
		$options['upload_url'] = url('/images/reward/');
		$options['upload_dir'] = public_path().'/images/reward/';
		$options['image_versions']['large'] = ['max_width'=>'360','max_height'=>'360','crop'=>true];
		$options['image_versions']['thumbnail'] = ['max_width'=>'80','max_height'=>'80','crop'=>true];
		$options['image_versions']['medium'] = ['max_width'=>'160','max_height'=>'160','crop'=>true];
		$upload_handler = new App\Http\Controllers\UploadController($options);
	});

	Route::post('user/upload/avatar', function(){
		$options['upload_url'] = url('/images/avatar/');
		$options['upload_dir'] = public_path().'/images/avatar/';
		$options['image_versions']['large'] = ['max_width'=>'360','max_height'=>'360','crop'=>true];
		$options['image_versions']['thumbnail'] = ['max_width'=>'80','max_height'=>'80','crop'=>true];
		$options['image_versions']['medium'] = ['max_width'=>'160','max_height'=>'160','crop'=>true];
		$upload_handler = new App\Http\Controllers\UploadController($options);
	});

	Route::group(['prefix' => 'admin','middleware' => ['auth', 'admin','except'=>'striptags']], function () {
		// Categories
		Route::get('categories/create', 'CategoryController@create');
		Route::get('categories/edit/{id?}', 'CategoryController@create');
		Route::post('categories/store', 'CategoryController@store');
		Route::post('categories/update', 'CategoryController@update');
		Route::get('categories/{type?}', 'CategoryController@index');
		// Contents
		Route::get('content/create', 'ContentController@create');
		Route::get('content/edit/{id?}', 'ContentController@create');
		Route::get('content/delete/{id?}', 'ContentController@delete');
		Route::get('content/destroy/{id?}', 'ContentController@destroy');
		Route::get('content/restore/{id?}', 'ContentController@restore');
		Route::post('content/store', 'ContentController@store');
		Route::post('content/update', 'ContentController@update');
		Route::get('content/{type?}', 'ContentController@index');
	});
	
	Route::get('{slug?}', 'ContentController@item');
});