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
		$this->styles = ['app.css','main.css'];
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

	public function BuildLayout(){
		$settings = Setting::allSetting();
		$navigations = [
			'super'=>[
				['title'=>'Төслүүд','url'=>url('projects')],
				['title'=>'Төсөл нэмэх','url'=>url('projects/add')],
				['title'=>'Бидний тухай','url'=>url('about/us')],
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
				['title'=>'Хамтран ажиллагсад','url'=>url('about/partners')],
				['title'=>'Дэмжигчид','url'=>url('about/supporters')],
				['title'=>'Үйлчилгээний нөхцөл','url'=>url('tos')],
			]
		];
		if ($this->user){
			$navigations['user'] = [
				['title'=>'Миний бүртгэл','url'=>url('user/profile')],
				['title'=>'Гарах','url'=>url('user/logout')],
			];
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
