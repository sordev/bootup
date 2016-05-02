@extends('layouts.default')

@section('header')
	@parent
@endsection

@section('content')

@include('errors.errors')
{!! Form::open(array('url'=>'user/update/profile/password','method'=>'post','class'=>'')) !!}
@include('modules.form.formgroup',['type'=>'password','label'=>trans('user.oldpassword'),'id'=>'password_old',$required='required'])
@include('modules.form.formgroup',['type'=>'password','label'=>trans('user.newpassword'),'id'=>'password_new',$required='required'])
@include('modules.form.formgroup',['type'=>'password','label'=>trans('user.newpasswordrepeat'),'id'=>'password_new_confirmation',$required='required'])
{!! Form::submit(trans('messages.update'),['class'=>'btn btn-default']) !!}
{!! Form::close() !!}
@endsection