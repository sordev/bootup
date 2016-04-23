<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CategoryType;


class Category extends Model {

	protected $table = 'categories';
	public $timestamps = true;
	public function getTypetitleAttribute()
    {
		$return = CategoryType::where('id',$this->type)->first();
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

	public function getTypeslugAttribute(){
		return CategoryType::find($this->type)->slug;
	}
}