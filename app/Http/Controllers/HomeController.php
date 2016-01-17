<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(){
		// 
		$slideshow = [
			['title'=>'Хамтдаа хөгжицгөөе','slide'=>asset('images/homeslides/1.jpg'),'cta'=>'Төсөл нэмэх','url'=>url('projects/add')],
			['title'=>'Хамтдаа хөгжицгөөе','slide'=>asset('images/homeslides/1.jpg'),'cta'=>'Төсөл нэмэх','url'=>url('projects/add')],
		];
		
		// Set metas for SEO
		$this->metas = [
			'title'=>'Бүүтап',
			'keywords'=>'bootup',
			'description'=>'Бүүтап төсөл, Хамтдаа хөгжицгөөе',
			'author'=>'Бүүтап',
		];
		
		$this->view = $this->BuildLayout();
		$this->view->withSlideshow($slideshow);
		return $this->view;
	}
}
