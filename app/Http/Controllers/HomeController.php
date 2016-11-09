<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Setting;
use App\Project;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(){
		//Slideshow
		$slideshow = [
			['title'=>'Туршилтын нээлт явагдаж байна','desc'=>'Төслийн туршилын хугацаа эхлэж байна.','slide'=>asset('images/homeslides/staging.jpg'),'cta'=>'Алдааны мэдээлэл илгээх','url'=>'https://docs.google.com/forms/d/e/1FAIpQLSd_DYqUn2EPkDblQpqr93mcJT5bvD40wgmaPKyHRXmvq1GrxQ/viewform?c=0&w=1'],
			['title'=>'BOOTUP.mn гэж юу вэ?','desc'=>'BootUP.mn бол мэдээллийн технологийн шинэлэг санаатай залууст эхний ээлжийн хөрөнгө оруулалтыг сайтаараа дамжуулан олон нийтээс босгох веб сайт юм. Бид зөвхөн эхний хөрөнгө оруулалт босгоод зогсохгүй зөвлөгөө өгч төслийг үр дүнтэй болгох талаас нь дэмжин ажиллах бөгөөд хөрөнгө оруулалтын хугацаа дуусмагц дараагийн хөрөнгө оруулагчтай холбох суваг нь болно. Танилцуулга материалыг <a href="https://dl.dropboxusercontent.com/u/46338286/bootup.pdf" target="_blank">эндээс татаарай</a>.','slide'=>asset('images/homeslides/main.jpg'),'cta'=>'Яг одоо өөрийнхөө төслийг оруулах','url'=>url('project/add')],
		];

		// Set metas for SEO
		$this->metas = [
			'title'=>'Бүүтап төслүүд',
			'keywords'=>'bootup',
			'description'=>'Бүүтап төсөл, Хамтдаа хөгжицгөөе',
			'author'=>'Бүүтап',
		];
		$projects = [];
		$projects['featured'] = Project::where('featured','1')->orderBy('created_at')->get()->take(4);
		$projects['updated'] = Project::orderBy('updated_at')->get()->take(4);
		$projects['new'] = Project::orderBy('created_at')->get()->take(4);

		$this->layout = 'main.homepage';
		$this->view = $this->BuildLayout();
		$this->view
			->withProjects($projects)
			->withSlideshow($slideshow)
			;
		return $this->view;
	}
}
