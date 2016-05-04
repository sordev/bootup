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

	public function comment(){
		return $this->hasMany('App\Comment','item_id');
	}

	public function donation()
	{
		return $this->hasMany('App\Payment', 'project_id')->where('reward_id',null);
	}

	public function leader()
	{
		return $this->belongsTo('App\User', 'user_id');
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
		$daysleft = 0;
		if($this->goal()->orderBy('start')->first()){
			$firstGoal = $this->goal()->orderBy('start')->first()->start;
			$start = new \Carbon\Carbon($firstGoal);
			$now = \Carbon\Carbon::now();
			
			if($start->diff($now)->days >= 1){
				$daysleft = $start->diff($now)->days;
			}
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
	
	public function getStatusTextAttribute(){
		$text = '';
		switch($this->status){
			case 0:
				$text = trans('messages.inactive');
			break;
			case 1:
				$text = trans('messages.active');
			break;
			case 2:
				$text = trans('messages.locked');
			break;
		}
		return $text;
	}

	public function getPercentageAttribute(){
		$totalGoal = $this->totalgoal;
		$totalPayment = $this->totalpayment;
		$percentage = 0;
		if($totalGoal && $totalPayment){
			$percentage = $totalPayment*100/$totalGoal;
			if($percentage > 100){
				$percentage = 100;
			}
		}
		return (int)$percentage;
	}

	public function getTotalPaymentAttribute(){
		$total = 0;
		foreach ($this->completedpayment as $p){
			$total = $total+($p->value);
		}
		return $total;
	}

	public function getCompletedPaymentAttribute(){
		return $this->payment()->where('status',1)->get();
	}

	public function getUrlAttribute(){
		return url('projects/'.$this->slug);
	}

	public function getEditUrlAttribute(){
		return url('project/edit/'.$this->id);
	}

	public function getSharesAttribute(){
		$sharelinks = [
			['href'=>'http://www.facebook.com/sharer.php?u='.$this->url.'&t='.$this->title,'class'=>'fb'],
			['href'=>'https://twitter.com/share?url='.$this->url.'&text='.$this->title,'class'=>'tw']
		];
		return $sharelinks;
	}

	public function getTeamAttribute(){
		$team = [];
		$this->leader->leader = true;
		$team[] = $this->leader;
		
		if(!empty($this->team_members)){
			$teamMembersArray = explode(',',$this->team_members);
			foreach ($teamMembersArray as $tid){
				$team[] = User::find($tid);
			}
		}
        return $team;
    }
}