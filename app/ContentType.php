<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContentType extends Model
{
    public static function getContentTypeOptions(){
		$return = [];
		$types = self::all();
		if($types){
			foreach ($types as $t){
				$return[$t->uniqid] = $t->title;
			}
		}
		return $return;
	}
}
