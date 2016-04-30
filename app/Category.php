<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CategoryType;


class Category extends Model {

	protected $table = 'categories';
	protected $guarded = [];
	public $timestamps = true;

	public function getTypetitleAttribute()
    {
		$return = CategoryType::where('id',$this->type)->first();
        return $return->title;
    }

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

	public function getUrlAttribute(){
		return url($this->typeslug.'/category/'.$this->slug);
	}
}