<?php

namespace App\Modules\Blog\Models;

use Illuminate\Database\Eloquent\Model;

class PostTag extends Model {

	protected $table = 'blog_post_tag';
	public $timestamps = false;

	public function posts()
	{
		return $this->belongsTo('Post', 'post_id');
	}

	public function tags()
	{
		return $this->hasOne('Tag');
	}

}