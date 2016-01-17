<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model {

	use Authenticatable, CanResetPassword;
	
	protected $table = 'users';
	public $timestamps = true;
	protected $hidden = array('salt', 'register_ip', 'forget_token', 'active_token');
	
	protected $fillable = [
	'username',
	'email',
	'usr_lname',
	'firstname',
	'lastname',
	'avatar',
	'bio',
	];

	public function role()
	{
		return $this->belongsToMany('Role');
	}

	public function attempts()
	{
		return $this->hasMany('Login_attempts');
	}
	
	public function getAuthPassword() {
		return $this->password;
	}

	public function profile(){
		return $this->hasMany('App\UserSocial','id','id');
	}

}