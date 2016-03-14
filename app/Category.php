<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CategoryType;


class Category extends Model {

	protected $table = 'categories';
	public $timestamps = true;
	public function getTypeAttribute($value)
    {
		if(\Route::getCurrentRoute()->getActionName() == 'App\Http\Controllers\CategoryController@create'){
			return $value;
		}
		$return = CategoryType::where('id',$value)->first();
        return $return->title;
    }
	protected $guarded = [];
	
	public static function getCategoryOptions($type=null){
		$return = [];
		if($type != null){
			$categories = self::where('type',$type)->orderBy('position','DESC')->get();
			if($categories){
				foreach ($categories as $c){
					$return[$c->id] = $c->title;
				}
			}
		}
		return $return;
	}

}