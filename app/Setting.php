<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model {

	protected $table = 'settings';
	public $timestamps = true;
	public static function getSetting($setting){
		$settingobj = Setting::where('name','=',$setting)->first();
		if ($settingobj){
			return $settingobj->value;
		} else {
			return false;
		}
	}
	public static function setSetting($setting,$newval){
		$settingobj = Setting::where('name','=',$setting)->first();
		if ($settingobj){
			$settingobj->value = $newval;
			$settingobj->save();
		}
	}
	public static function addSetting($setting,$value){
		$settingobj = Setting::where('name','=',$setting)->first();
		if ($settingobj){
			return;
		}
		$settingobj = new Setting;
		if ($setting){
			$settingobj->name = $setting;
			$settingobj->value = $value;
			$settingobj->save();
		}
	}
	
	public static function allSetting(){
		$settingobj = Setting::all();
		$return = array();
		foreach ($settingobj as $o){
			$return[$o->name]=$o->value;
		}
		return $return;
	}

}