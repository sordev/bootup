@extends('layouts.default')

@section('header')
	@parent
@endsection

@section('content')

@include('errors.errors')
{!! Form::open(array('url'=>'user/update/profile','method'=>'post','class'=>'')) !!}
	@include('modules.form.formgroup',['data'=>$user,'type'=>'text','label'=>trans('project.lastname'),'id'=>'lastname','required'=>'required'])
	@include('modules.form.formgroup',['data'=>$user,'type'=>'text','label'=>trans('project.firstname'),'id'=>'firstname','required'=>true])
	@include('modules.form.formgroup',['data'=>$user,'type'=>'text','label'=>trans('project.username'),'id'=>'username','note'=>trans('project.showothersyouraddress'),'required'=>true])
	@include('modules.form.formgroup',['data'=>$user,'type'=>'text','label'=>trans('project.email'),'id'=>'email','required'=>true])
	@include('modules.form.formgroup',['data'=>$user,'type'=>'select','label'=>trans('project.whetherpublicly'),'id'=>'public','option'=>['1'=>trans('messages.yes'),'0'=>trans('messages.no')],'required'=>true])
	@include('modules.upload.uploaditem',['id'=>'avatar','label'=>trans('project.avatar'),'view'=>'create','old'=>$user->avatar])
	@include('modules.form.formgroup',['data'=>$user,'type'=>'textarea','cke'=>'true','label'=>trans('project.aboutme'),'id'=>'bio'])
	{!! Form::submit(trans('project.update'),['class'=>'btn btn-default']) !!}
{!! Form::close() !!}
@endsection
