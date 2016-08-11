<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model {

	protected $table = 'comments';
	public $timestamps = true;

	use SoftDeletes;

	protected $dates = ['deleted_at'];

	public function project(){
		return $this->belongsTo('App\Project','item_id');
	}

	public function content(){
		return $this->belongsTo('App\Content','item_id');
	}

	public function user(){
		return $this->belongsTo('App\User','user_id');
	}
	
	public function getReplyAttribute(){
		return self::where('reply_id',$this->id)->get();
	}

}