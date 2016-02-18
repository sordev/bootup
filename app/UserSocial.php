<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSocial extends Model {

	protected $table = 'users_socials';
	public $timestamps = true;

	public function user()
	{
		return $this->belongsTo('App\User');
	}

}