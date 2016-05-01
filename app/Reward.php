<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reward extends Model {

	protected $table = 'rewards';
	public $timestamps = true;
	
	public function getAmountLeftAttribute(){
		$amount = $this->amount;
		$sold = \App\Payment::where('reward_id',$this->id)->get();
		
		return (int)$amount-count($sold);
	}

}