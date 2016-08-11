<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract{

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
	'status',
	'role',
	];

	public function role()
	{
		return $this->belongsTo('App\Role');
	}

	public function getFullnameAttribute(){
		return $this->firstname.' '.$this->lastname;
	}

	public function projects(){
		return $this->hasMany('App\Project','user_id');
	}

	public function payments(){
		return $this->hasMany('App\Payment','user_id');
	}
	
	public function getUrlAttribute(){
		return url('user/profile/'.$this->username);
	}

	public function getTotalPaymentsAttribute(){
		$payments = $this->payments;
		$paymentsArray = [];
		foreach($payments as $p){
			$paymentsArray[$p->project_id][]=$p->value;
		}
		$paymentsArrayValue = [];
		foreach($paymentsArray as $k => $pa){
			$value=0;
			foreach($pa as $v){
				$value = $value+$v;
			}
			$project = \App\Project::find($k);
			$paymentsArrayValue[$k] = ['title'=>$project->title,'url'=>$project->url,'value'=>$value];
		}
		return $paymentsArrayValue;
	}

	public function attempts()
	{
		return $this->hasMany('Login_attempts');
	}

	public function getAuthPassword() {
		return $this->password;
	}

	public function usersocial(){
		return $this->hasMany('App\UserSocial','id','user_id');
	}

	public function comment(){
		return $this->hasMany('App\Comment','user_id');
	}

	public function isAdmin(){
		if($this->role == 1){
			return true;
		}
		return false;
	}

	public static function getUserbyid($id){
		if(is_numeric($id)){
			$return = User::find($id);
		} else {
			$return = User::where('username',$id)->first();
		}
		return $return;
	}
}