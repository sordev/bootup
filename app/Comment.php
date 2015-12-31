<?php

namespace Comment;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model {

	protected $table = 'comments';
	public $timestamps = true;

	use SoftDeletes;

	protected $dates = ['deleted_at'];

}