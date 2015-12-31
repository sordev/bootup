<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model {

	protected $table = 'roles';
	public $timestamps = false;

	public function permissions()
	{
		return $this->belongsToMany('Permission');
	}

	public function users()
	{
		return $this->belongsToMany('User');
	}

}