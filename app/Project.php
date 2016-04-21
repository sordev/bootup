<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Category;
use App\User;
use App\Goal;

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
		return $this->hasMany('Reward', 'project_id');
	}

	public function gateway()
	{
		return $this->hasMany('Payment', 'project_id');
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

	public function getTeamAttribute()
    {
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