<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model {

	protected $table = 'payments';
	public $timestamps = true;

	public function project()
	{
		return $this->belongsTo('App\Project', 'project_id');
	}

	public function user()
	{
		return $this->belongsTo('App\User', 'user_id');
	}

	public function reward()
	{
		
		return $this->belongsTo('App\Reward', 'reward_id');
	}

	public function getValueTextAttribute(){
		return number_format($this->value).' '.trans('messages.currencysymbol');
	}

	public function getStatusTextAttribute(){
		$text = '';
		switch($this->status){
			case 0:
				$text = trans('payment.inactive');
			break;
			case 1:
				$text = trans('payment.active');
			break;
			case 2:
			break;
		}
		return $text;
	}
}