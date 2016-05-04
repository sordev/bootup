<?php
App::setLocale('mn');
//Starting 5.2 web middleware has to be included
Route::group(['middleware' => ['web','striptags']], function () {
	//Home Route
	Route::get('/', 'HomeController@index');
	Route::get('home', 'HomeController@index');
	Route::get('blog', 'ContentController@blog');
	Route::get('blog/category/{category_slug}', 'ContentController@blog');
	Route::get('blog/search', 'ContentController@blog');
	Route::get('blog/{category_slug}/{slug}', 'ContentController@blogItem');

	//User Route
	Route::get('/user/login/{provider?}', 'UserController@login');
	Route::post('/user/loginpost', 'UserController@loginPost');
	Route::get('user/register', 'UserController@create');
	Route::get('user/logout', 'UserController@logout');
	Route::post('user/store', 'UserController@store');
	Route::get('user/profile/{id?}', 'UserController@profile');
	Route::post('user/contact/modal', 'UserController@contactUserModal');
	Route::post('user/contact', 'UserController@contactUser');
	
	//Forgot Password
	Route::get('user/reset/password', 'Auth\PasswordController@getEmail');
	Route::post('user/reset/password', 'Auth\PasswordController@postEmail');
	// Password reset routes...
	Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
	Route::post('password/reset', 'Auth\PasswordController@postReset');
	
	Route::post('user/search/modal', 'UserController@searchUserModal');
	Route::post('user/search/list', 'UserController@searchUserList');
	//Projects
	Route::get('projects', 'ProjectController@projects');
	Route::get('project/category/{category?}', 'ProjectController@projects');
	Route::get('project/search', 'ProjectController@projectsSearch');
	//Project
	Route::get('projects/{slug?}', 'ProjectController@project');
	
	Route::post('project/claim/rewardmodal', 'ProjectController@claimRewardModal');
	Route::post('project/claim/reward', 'ProjectController@claimReward');
	
	Route::get('project/add', 'ProjectController@add');
	
	//Edit routes
	Route::group(['middleware' => ['auth']], function () {
		//User Projects
		Route::get('user/projects', 'ProjectController@userProjects');
		
		Route::get('project/edit/{id?}', 'ProjectController@edit');
		Route::post('project/update', 'ProjectController@update');
		Route::get('project/delete/{id?}', 'ProjectController@delete');
		Route::get('project/enable/{id?}', 'ProjectController@enable');
		Route::get('project/disable/{id?}', 'ProjectController@disable');
		Route::get('project/lock/{id?}', 'ProjectController@lock');
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
		Route::get('user/edit/profile/password', 'UserController@editPassword');
		Route::post('user/update/profile/password', 'UserController@updatePassword');
		Route::post('user/update/profile', 'UserController@update');
		//Payments
		Route::post('project/supporter/listmodal','ProjectController@supporterListModal');
		Route::get('user/support','UserController@support');
		
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
		// Projects
		Route::get('projects', 'ProjectController@adminProjects');
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