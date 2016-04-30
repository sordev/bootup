<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Category;
use App\User;
use App\Goal;
use App\Reward;
use App\Payment;

class Project extends Model {

	protected $table = 'projects';
	public $timestamps = true;

	use SoftDeletes;

	protected $dates = ['deleted_at'];

	public function goal()
	{
		return $this->hasMany('App\Goal', 'project_id')->orderBy('phase');
	}

	public function reward()
	{
		return $this->hasMany('App\Reward', 'project_id');
	}

	public function payment()
	{
		return $this->hasMany('App\Payment', 'project_id');
	}

	public function getCategoriesAttribute()
    {
		$catIdArray = explode(',',$this->category_ids);
		$categories = [];
		foreach ($catIdArray as $cid){
			$categories[] = Category::find($cid);
		}
        return $categories;
    }

	public function getDaysLeftAttribute()
    {
		$firstGoal = $this->goal()->orderBy('start')->first()->start;
		$start = new \Carbon\Carbon($firstGoal);
		$now = \Carbon\Carbon::now();
		$daysleft = 0;
		if($start->diff($now)->days >= 1){
			$daysleft = $start->diff($now)->days;
		}
		return $daysleft;
    }

	public function getTotalGoalAttribute(){
		$goals = $this->goal;
		$total = 0;
		foreach ($goals as $g){
			$total = $total+($g->goal);
		}
		return $total;
	}

	public function getPercentageAttribute(){
		$totalGoal = $this->totalgoal;
		$totalPayment = $this->totalpayment;
		
		$percentage = $totalPayment*100/$totalGoal;
		if($percentage > 100){
			$percentage = 100;
		}
		return (int)$percentage;
	}

	public function getTotalPaymentAttribute(){
		$payments = $this->payment;
		$total = 0;
		foreach ($payments as $p){
			$total = $total+($p->value);
		}
		return $total;
	}

	public function getUrlAttribute(){
		return url('projects/'.$this->slug);
	}

	public function getTeamAttribute(){
		$team = [];
		$teamleader = User::find($this->user_id);
		if($teamleader){
			$teamleader->leader = true;
			$team[] = $teamleader;
		}
		if(!empty($this->team_members)){
			$teamMembersArray = explode(',',$this->team_members);
			foreach ($teamMembersArray as $tid){
				$team[] = User::find($tid);
			}
		}
        return $team;
    }
}