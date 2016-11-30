@extends('layouts.default')
@section('header')
	@parent
@endsection

@section('content')
	<section class="text-center">
		<h2>Яаж вэ?</h2>
		<div class="row">
			<div class="col-md-4 col-md-4 col-sm-6">
				<div class="home-step-box">
					<a href="{{url('project/add')}}"><img src="{{{asset('images/main/add-project.jpg')}}}" alt="Төслөө нэм"/></a>
				</div>
				<h4>1.<b>{{trans('project.addproject')}}</h4>
			</div>
			<div class="col-md-4 col-md-4 col-sm-6">
				<div class="home-step-box">
					<img src="{{{asset('images/main/share-project.jpg')}}}" alt="Төслөө нэм"/>
				</div>
				<h4>2.<b>{{trans('project.activeprojectrange')}}</h4>
			</div>
			<div class="col-md-4 col-md-4 col-sm-6">
				<div class="home-step-box">
					<img src="{{{asset('images/main/make-project.jpg')}}}" alt="Төслөө нэм"/>
				</div>
				<h4>3.<b>{{trans('project.fulfillyourdream')}} </h4>
			</div>
		</div>
	</section>
	<div class="padding-sm">
	</div>
</div>
	<section class="blue-box projects">
		<div class="padding-sm">
		</div>
		<div class="container">
			<ul class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active"><a href="#featured" aria-controls="featured" role="tab" data-toggle="tab"><br>{{trans('project.featuredprojects')}}</a></li>
				<li role="presentation"><a href="#new" aria-controls="new" role="tab" data-toggle="tab"><br>{{trans('project.Newadded')}}</a></li>
				<li role="presentation"><a href="#updated" aria-controls="updated" role="tab" data-toggle="tab"><br>{{trans('project.Updated')}}</a></li>
			</ul>
			<div class="tab-content">
				<div role="tabpanel" class="tab-pane active" id="featured">
					@include('modules.project.homepage.list',['projects'=>$projects['featured']])
				</div>
				<div role="tabpanel" class="tab-pane" id="new">
					@include('modules.project.homepage.list',['projects'=>$projects['new']])
				</div>
				<div role="tabpanel" class="tab-pane" id="updated">
					@include('modules.project.homepage.list',['projects'=>$projects['updated']])
				</div>
			</div>
		</div>
		<div class="padding-sm">
		</div>
	</section>
<div class="container">
	<section class="text-center">
		<h2>Яагаад үүнийг хийх болов?</h2>
		<p>Монгол улсын хөгжилийг мэдээллийн технологийн залуус бид л тодорхойлно.</p>
		<div class="row">
			<div class="col-md-4 col-md-4 col-sm-6">
				<div class="feature feature-3 clearfix mb-xs-24 mb64">
					<div class="left">
						<i class="fa fa-level-up"></i>
					</div>
					<div class="right">
						<h3 class="uppercase mb16">Мэдээллийн технологи хөгжлийн гарц</h3>
						<p>
							Монгол улсын хөгжилийг мэдээллийн технологийн залуус бид л тодорхойлно. 13 хүнтэй instagram сайт Facebook-д 1 тэрбум доллароор зарагдсан нь бидэнд боломж байгааг харуулж байна.
						</p>
					</div>
				</div>
				<!--end of feature-->
			</div>

			<div class="col-md-4 col-md-4 col-sm-6">
				<div class="feature feature-3 clearfix mb-xs-24 mb64">
					<div class="left">
						<i class="fa fa-hand-rock-o"></i>
					</div>
					<div class="right">
						<h3 class="uppercase mb16">Монголчууд чадна</h3>
						<p>
							Бид хүн амын тоогоороо дэлхийн 200 гаруй улсын 140 хавьцаа жагсдаг боловч IQ-аараа эхний 10т багтдаг сонирхолтой улс. Азийн оюун ухааны олимпод тасархай түрүүлдэг тийм л үндэстэн.
						</p>
					</div>
				</div>
				<!--end of feature-->
			</div>

			<div class="col-md-4 col-md-4 col-sm-6">
				<div class="feature feature-3 clearfix mb-xs-24 mb64">
					<div class="left">
						<i class="fa fa-lightbulb-o"></i>
					</div>
					<div class="right">
						<h3 class="uppercase mb16">Оюуны бүтээл зардал багатай</h3>
						<p>
							Бүтээгдэхүүн үйлдвэрлэхэд цалин, серверийн зардлаа шийдчихсэн байхад асуудал байхгүй. Гадны бусад орнуудтай харьцуулахад Монголын цалингийн зардал 5-10 дахин бага.
						</p>
					</div>
				</div>
				<!--end of feature-->
			</div>
		</div>
		<div class="row">
			<div class="col-md-4 col-md-4 col-sm-6">
				<div class="feature feature-3 clearfix mb-xs-24 mb64">
					<div class="left">
						<i class="fa fa-question"></i>
					</div>
					<div class="right">
						<h3 class="uppercase mb16">Зээл авахад хүндрэлтэй</h3>
						<p>
							Танд ямар ч гоё төсөл, сайн баг байлаа гээд барьцаа хөрөнгө байхгүй бол зээл авах боломж хомс. Банкны хүү өндөр, хөрөнгийн зах зээл хөгжөөгүйн улмаас дотоодоосоо мөнгө босгоход хүндрэлтэй.
						</p>
					</div>
				</div>
				<!--end of feature-->
			</div>
			<div class="col-md-4 col-md-4 col-sm-6">
				<div class="feature feature-3 clearfix mb-xs-24 mb64">
					<div class="left">
						<i class="fa fa-umbrella"></i>
					</div>
					<div class="right">
						<h3 class="uppercase mb16">Хөрөнгө оруулагчид ойлголт муутай</h3>
						<p>
							Хөрөнгө оруулагчтай уулзлаа ч тэд энэ салбарыг ойлгохгүй учраас 2, 3 жилийн дараанаас үр ашгаа өгөх бизнест хөрөнгө оруулах нь бага. Хөрөнгө оруулсан ч компанийн 50-иас дээш хувийг авахыг санал болгодог.
						</p>
					</div>
				</div>
				<!--end of feature-->
			</div>
			<div class="col-md-4 col-md-4 col-sm-6">
				<div class="feature feature-3 clearfix mb-xs-24 mb64">
					<div class="left">
						<i class="fa fa-usd"></i>
					</div>
					<div class="right">
						<h3 class="uppercase mb16">Онлайн гүйлгээ хөгжсөн</h3>
						<p>
							Нэг үеэ бодвол бид онлайнаар гүйлгээ хийхэд ямар ч асуудалгүй болсон. Гадаад дотоодын хүмүүсээс хөрөнгө босгоход асуудал байхгүй.
						</p>
					</div>
				</div>
				<!--end of feature-->
			</div>
		</div>
	</section>
	<section class="text-center">
		<div class="row">
			<div class="col-md-12">
				<div class="content-page clearfix">
					<h2>Төслийн үр дүн</h2>
					<p class="desc">Монголын мэдээлэл технологийн хөгжил нэг шатаар ахина.</p>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<article class="icon-round">
					<div class="service-icon">
						{{-- <img src="http://bootup.mn/wp-content/themes/bootup/img/graph1.jpg" alt=""> --}}
					</div>
					<div class="service-content">
						<h3>МТ-ийн үйлдвэрлэл нэмэгдэнэ</h3>
						<p>Мэдээлэл технологийн чиглэлээр ажилладаг залуусыг дэмжиж тэдний хийх гээд чадахгүй байгаа зүйлд олон нийтийг татан хөрөнгө оруулснаар МТ-ийн бүтээгдэхүүн үйлдвэрлэл тодорхой хэмжээгээр нэмэгдэж импортыг орлох бүтээгдэхүүн олноор төрөн гарах болно.</p>
					</div>
				</article>
			</div>
			<div class="col-md-6">
				<article class="icon-round">
					<div class="service-icon">
						{{-- <img src="http://bootup.mn/wp-content/themes/bootup/img/graph2.jpg" alt=""> --}}
					</div>
					<div class="service-content">
						<h3>МТ-ийн залуус мөрөөдөлдөө илүү ойртоно</h3>
						<p>Залууст тулгардаг хамгийн том асуудал нь эхний хөрөнгө оруулалт байдаг. Банк зээл өгөхгүй, хөрөнгө оруулагчид хэт эрсдэлтэй гэж үздэг учраас тэдэнд мөрөөдлөө биелүүлэх боломж хомс байдаг. Тэгвэл бид энэ асуудлыг бага ч болон шийдэх юм.</p>
					</div>
				</article>
			</div>
		</div><!-- End row -->

		<div class="row">
			<div class="col-md-6">
				<article class="icon-round">
					<div class="service-icon">
						{{-- <img src="http://bootup.mn/wp-content/themes/bootup/img/graph3.jpg" alt=""> --}}
					</div>
					<div class="service-content">
						<h3>МТ-ийг хүмүүс илүү ойлгодог болно</h3>
						<p>МТ-ийг хэрэглэгчид, хөрөнгө оруулагчид төдийлөн салбарын залуусын хийсэн бүтээлийг ойлгож хүлээж авдаггүй. Бид хөрөнгө оруулалт татах зорилгоор хэрэглэгч, хөрөнгө оруулагчид тэдний бүтээлийг сурталчилан таниулж хөрөнгө татах учраас тэдний мэдлэг бага багаар нэмэгдэх нь гарцаагүй.</p>
					</div>
				</article>
			</div>
			<div class="col-md-6">
				<article class="icon-round">
					<div class="service-icon">
						{{-- <img src="http://bootup.mn/wp-content/themes/bootup/img/graph4.jpg" alt=""> --}}
					</div>
					<div class="service-content">
						<h3>МТ-оор экспорт хийгдэнэ</h3>
						<p>Бидний гол зорилго бол залуусын бүтээлийг дэлхийн түвшинд хүргэж, дэлхийн хэмжээний бүтээгдэхүүн хийхэд нь туслаж, гадны хөрөнгө оруулагчидтай холбож цаашид дэлхийн зах зээл дээр бүтээгдэхүүнээ борлуулах гарцыг нь нээж өгөх юм.</p>
					</div>
				</article>
			</div>
		</div>
	</section>
	<section class="text-center">
		<h2>Хамтрагч байгууллагууд</h2>
		<div class="row">
			<div class="col-md-3">
				LOGO 1
			</div>
			<div class="col-md-3">
				LOGO 2
			</div>
			<div class="col-md-3">
				LOGO 3
			</div>
			<div class="col-md-3">
				LOGO 4
			</div>
		</div>
	</section>

@endsection
