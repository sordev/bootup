<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model {

	protected $table = 'projects';
	public $timestamps = true;

	use SoftDeletes;

	protected $dates = ['deleted_at'];

	public function goal()
	{
		return $this->hasMany('Goal', 'project_id');
	}

	public function reward()
	{
		return $this->hasMany('Reward', 'project_id');
	}

	public function gateway()
	{
		return $this->hasMany('Payment', 'project_id');
	}

}