<?php 

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});


Route::resource('role', 'RoleController');
Route::resource('user', 'UserController');
Route::resource('permission', 'PermissionController');
Route::resource('permission_role', 'Permission_roleController');
Route::resource('role_user', 'Role_userController');
Route::resource('login_attempts', 'login_attemptsController');
Route::resource('usersocial', 'UserSocialController');
