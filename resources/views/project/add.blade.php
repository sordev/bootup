@extends('layouts.default')
@section('header')
	@parent
	<p>Төсөл нэмэх гэж буйд баярлалаа.</p>
	<p>
		Юун түрүүнд төсөл гэж буй танд баярлалаа. Таны төсөл бусдад болон танд өр өгөөжтэй гайхалтай төсөл гэдэгт бид итгэлтэй байна. Гэхдээ та төслөө оруулахаас өмнө дараахи зүйлсийг бэлдсэн байх хэрэгтэйг сануулъя.
		<ul>
			<li>Төслийн танилцуулга</li>
		</ul>
		Мөн та төслөө оруулахаас өмнө дүрэм журам, үйлчилгээний нөхцөл зэрэгтэй сайтар танилцахыг зөвлөж байна.
		<div class="row">
			@foreach($content_data as $cd)
				<div class="col-md-3">
					<div class="well">
						<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#{{{$cd['id']}}}">
							{{{$cd['title']}}}
						</button>
						@include('modules.modal',['id'=>$cd['id'],'modalbody'=>'content.modalitem','title'=>$cd['title'],'vars'=>['content'=>$cd['content']]])
					</div>
				</div>
			@endforeach
		</div>
	</p>
@endsection

@section('content')
	@include('errors.errors')
	<div class="well well-lg projectsteps">
		@if(!$user)
			<div class="step-register">
				<h3>Бүртгүүлэх</h3>
				<p>
					Төслөө оруулахын тулд та эхлээд бүртгүүлсэн байх шаардлагатай. Тэгснээр та төслийн явцыг оруулах хянах эрхтэй болох юм. Түүнчлэн таныг төслийн эзэмшигч гэдгийг таны бүртгэл батлах болно.
				</p>
				@include('modules.user.register')
			</div>
		@else
			{!! Form::open(array('url'=>'/','method'=>'post','class'=>'')) !!}
				<div class="projectstepcontainer">
					@include('project.steps.addproject')
				</div>
			{!! Form::close() !!}
		@endif
	</div>
@endsection