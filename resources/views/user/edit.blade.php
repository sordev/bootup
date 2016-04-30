@extends('layouts.default')

@section('header')
	@parent
@endsection

@section('content')

@include('errors.errors')
{!! Form::open(array('url'=>'user/update/profile','method'=>'post','class'=>'')) !!}
	@include('modules.form.formgroup',['data'=>$user,'type'=>'text','label'=>'Овог','id'=>'lastname','required'=>'required'])
	@include('modules.form.formgroup',['data'=>$user,'type'=>'text','label'=>'Нэр','id'=>'firstname','required'=>true])
	@include('modules.form.formgroup',['data'=>$user,'type'=>'text','label'=>'Хэрэглэгчийн нэр','id'=>'username','note'=>'Таныг бусдад харуулах хаяг user/profile/ТАНЫ_СОНГОСОН_ХЭРЭГЛЭГЧИЙН_НЭР','required'=>true])
	@include('modules.form.formgroup',['data'=>$user,'type'=>'text','label'=>'Имэйл хаяг','id'=>'email','required'=>true])
	@include('modules.form.formgroup',['data'=>$user,'type'=>'select','label'=>'Нийтэд харагдах эсэх','id'=>'public','option'=>['1'=>'Тийм','0'=>'Үгүй'],'required'=>true])
	@include('modules.upload.uploaditem',['id'=>'avatar','label'=>'Аватар зураг','view'=>'create','old'=>$user->avatar])
	@include('modules.form.formgroup',['data'=>$user,'type'=>'textarea','cke'=>'true','label'=>'Миний тухай','id'=>'bio'])
	{!! Form::submit('Шинэчилэх',['class'=>'btn btn-default']) !!}
{!! Form::close() !!}
@endsection