<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model {

	protected $table = 'payments';
	public $timestamps = true;
	
	public function project()
	{
		return $this->belongsTo('App\Project', 'project_id');
	}
}