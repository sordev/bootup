<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

//settings model
use App\Setting as Setting;
//use App\Navigations;
use Auth;

abstract class Controller extends BaseController
{
    use DispatchesJobs, ValidatesRequests;

	public $styles;
	public $scripts;
	public $metas;
	public $layout;
	public $view;
	public $user;

	public function __construct(){
		$this->styles = ['app.css','all.css'];
		$this->layout = 'layouts.default';
		$this->user = Auth::user();
		$this->scripts = [
			'header'=>['https://code.jquery.com/jquery-2.1.4.min.js','https://www.google.com/recaptcha/api.js?hl=mn&render=explicit&onload=callRecaptcha'],
			'footer'=>['bootstrap.min.js','app.js']
		];
		
		$recaptchakey = Setting::getSetting('recaptchakey');
		$this->view = $this->BuildLayout()->with('recaptchakey',$recaptchakey);

		$this->metas = array(
			'description'=>Setting::getSetting('description'),
			'keywords'=>Setting::getSetting('keywords'),
			'author'=>Setting::getSetting('author'),
			'title'=>Setting::getSetting('title'),
			);
	}
	
	/**
	 * get youtube video ID from URL
	 *
	 * @param string $url
	 * @return string Youtube video id or FALSE if none found. 
	 */
	function youtube_id_from_url($url) {
		$pattern = 
			'%^# Match any youtube URL
			(?:https?://)?  # Optional scheme. Either http or https
			(?:www\.)?      # Optional www subdomain
			(?:             # Group host alternatives
			  youtu\.be/    # Either youtu.be,
			| youtube\.com  # or youtube.com
			  (?:           # Group path alternatives
				/embed/     # Either /embed/
			  | /v/         # or /v/
			  | /watch\?v=  # or /watch\?v=
			  )             # End path alternatives.
			)               # End host alternatives.
			([\w-]{10,12})  # Allow 10-12 for 11 char youtube id.
			$%x'
			;
		$result = preg_match($pattern, $url, $matches);
		if ($result) {
			return $matches[1];
		}
		return false;
	}
	
	public function parseVideoUrl($video){
		$return['status'] = false;
		$parsed = parse_url($video);
		if(isset($parsed['host']) && !empty($parsed['host'])){
			switch($parsed['host']){
				case 'www.youtube.com':
				case 'youtube.com':
				case 'youtu.be':
					$return['status'] = true;
					$return['type'] = 'youtube';
					$return['id'] = $this->youtube_id_from_url($video);
					if($return['id'] == false){
						$return['status'] = false;
						$return['errors'] = ['video'=>['Youtube Сувгийн хаяг дэмжихгүй']];
					}
				break;
				case 'vimeo.com':
				case 'www.vimeo.com':
					$return['status'] = true;
					$return['type'] = 'vimeo';
					$return['id'] = (int) substr(parse_url($video, PHP_URL_PATH), 1);
					if ($return['id'] == 0){
						$return['status'] = false;
						$return['errors'] = ['video'=>['Vimeo Сувгийн хаяг дэмжихгүй']];
					}
				break;
				default:
					$return['status'] = false;
					$return['errors'] = ['video'=>['Youtube эсвэл Vimeo видеоны хаяг тавина уу']];
				break;
			}
		} else {
			$return['status'] = false;
			$return['errors'] = ['video'=>['Youtube эсвэл Vimeo видеоны хаяг тавина уу']];
		}
		return $return;
	}

	public function BuildLayout(){
		$settings = Setting::allSetting();
		$navigations = [
			'super'=>[
				['title'=>'Төслүүд','url'=>url('projects')],
				['title'=>'Төсөл нэмэх','url'=>url('project/add')],
				['title'=>'Бидний тухай','url'=>url('about-us')],
			],
			'user'=>[
				['title'=>'Нэвтрэх','url'=>'#','attributes'=>[
						'data-toggle'=>'modal',
						'data-target'=>'#loginModal',
					],
				],
				['title'=>'Бүртгүүлэх','url'=>'#','attributes'=>[
						'data-toggle'=>'modal',
						'data-target'=>'#registerModal',
					],
				],
			],
			'about'=>[
				['title'=>'Блог','url'=>url('blog')],
				['title'=>'Хамтран ажиллагсад','url'=>url('about-partners')],
				['title'=>'Дэмжигчид','url'=>url('about-supporters')],
				['title'=>'Үйлчилгээний нөхцөл','url'=>url('tos')],
			],
			'help'=>[
				['title'=>'Түгээмэл асуулт, хариулт','url'=>url('faq')],
				['title'=>'Хэрхэн хөрөнгө оруулах','url'=>url('funding')],
				['title'=>'Төслийн шалгуур','url'=>url('requirment')]
			]
		];
		
		$categories = \App\Category::where('type',1)->get();
		foreach($categories as $c){
			$navigations['categories'][]=['title'=>$c->title,'url'=>$c->url];
		}

		if ($this->user){
			$navigations['profile'] = [
				['title'=>'Миний төслүүд','url'=>url('user/projects')],
				['title'=>'Дэмжсэн төслүүд','url'=>url('user/support')],
				['title'=>'Бүртгэлийн тохиргоо','url'=>url('user/edit/profile')],
			];
			
			$navigations['user'] = [
				['title'=>'Миний бүртгэл','url'=>url('user/profile'),'child'=>$navigations['profile']],
				['title'=>'Гарах','url'=>url('user/logout')],
			];
			
			$navigations['admin'] = [
				['title'=>'Төслүүд','url'=>url('admin/projects')],
				['title'=>'Ангилалууд','url'=>url('admin/categories')],
				['title'=>'Агуулгууд','url'=>url('admin/content')],
			];
			
			if ($this->user->role == 1){
				$navigations['user'][] = ['title'=>'Админ цэс','url'=>url('admin'),'child'=>$navigations['admin']];
			}
		}
		
		$recaptchakey = Setting::getSetting('recaptchakey');
		
		$this->view = view($this->layout)
			->withStyles($this->styles)
			->withScripts($this->scripts)
			->withSettings($settings)
			->withMetas($this->metas)
			->withNavigations($navigations)
			->with('recaptchakey',$recaptchakey)
		;

		if ($this->user){
			$this->view->withUserlevel($this->user->usr_level);
		}
		return $this->view;
		// Run the 'csrf' filter on all post, put, patch and delete requests.
		//$this->beforeFilter('csrf', ['on' => ['post', 'put', 'patch', 'delete']]);
	}
	
}
