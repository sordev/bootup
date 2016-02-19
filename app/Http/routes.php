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
	//Projects
	Route::get('projects/add', 'ProjectController@add');
	//Forgot Password
	Route::get('user/reset/password', 'Auth\PasswordController@getEmail');
	Route::post('user/reset/password', 'Auth\PasswordController@postEmail');
	
});