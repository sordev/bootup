<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Content extends Model
{
	use SoftDeletes;
	protected $dates = ['deleted_at'];
    protected $guarded = [];
	public $timestamps = true;
	
	public function getAuthorAttribute(){
		$author = User::find($this->user_id);
		return $author;
	}

	public static function getContent($slug=null){
		$content = self::where('slug',$slug)->where('status','publish')->first();
		return $content;
	}
}
