<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Login_attempts extends Model {

	protected $table = 'login_attempts';
	public $timestamps = false;

}