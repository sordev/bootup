<?php

namespace UserSocial;

use Illuminate\Database\Eloquent\Model;

class UserSocial extends Model {

	protected $table = 'users_socials';
	public $timestamps = true;

	public function usersocial()
	{
		return $this->belongsTo('User', 'id');
	}

}