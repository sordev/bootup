<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Category;
use App\Project;
use Str;
class Content extends Model
{
	use SoftDeletes;
	protected $dates = ['deleted_at'];
    protected $guarded = [];
	public $timestamps = true;
	
	public function getAuthorAttribute(){
		$author = User::find($this->user_id);
		return $author;
	}

	public static function getContent($slug=null){
		$content = self::where('slug',$slug)->where('status','publish')->first();
		return $content;
	}

	public function category(){
		return $this->belongsTo('App\Category','category_id');
	}

	public function project(){
		return $this->belongsTo('App\Project','category_id');
	}

	public function contenttype(){
		return $this->belongsTo('App\ContentType','type');
	}

	public function comment(){
		return $this->hasMany('App\Comment','item_id')->where('type',3)->where('reply_id',null)->orderBy('id','DESC');
	}

	public function getSummaryAttribute(){
		if(empty($this->summary)){
			return str_limit(strip_tags($this->content), 1200);
		}
		return;
	}

	public function getUrlAttribute(){
		$url = '';
		switch($this->type){
			case 1:
				$url = $this->slug;
			break;
			case 2:
				$url = 'blog/'.$this->category->slug.'/'.$this->slug;
			break;
			case 3:
				$url = 'projects/'.$this->project->slug.'/updates/'.$this->slug;
			break;
		}
		return url($url);
	}

	public function getSharesAttribute(){
		$sharelinks = [
			['href'=>'http://www.facebook.com/sharer.php?u='.$this->url.'&t='.$this->title,'class'=>'fb'],
			['href'=>'https://twitter.com/share?url='.$this->url.'&text='.$this->title,'class'=>'tw']
		];
		return $sharelinks;
	}
}
