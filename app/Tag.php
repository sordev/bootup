<?php

namespace App\Modules\Blog\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model {

	protected $table = 'blog_tags';
	public $timestamps = false;

	public function TagToPost()
	{
		return $this->belongsTo('PostTag');
	}

}