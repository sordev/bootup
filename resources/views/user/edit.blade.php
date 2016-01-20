@extends('layouts.default')

@section('sidebar')
    @parent
@endsection

@section('header')
	<p>
		Edit user profile.
	</p>
@endsection

@section('content')

@if($errors->any())
	@include('errors.errors')
@endif
@if (session('status'))
    <div class="ui message success">
        {{ session('status') }}
    </div>
@endif
{!! Form::open(array('url'=>'user/update/profile','method'=>'post','class'=>'ui form editprofileform','files' => true)) !!}  

<div class="ui styled accordion">
	<div class="title active">
		<i class="dropdown icon"></i>
		Account and Contact information
	</div>
	<div class="content active">
		<div class="three fields">
			<div class="required field">
				{!! Form::label('usr_fname','First Name') !!}
				{!! Form::text('usr_fname',$user->usr_fname,['placeholder'=>'First Name','required']) !!}
			</div>
			<div class="required field">
				{!! Form::label('usr_lname','Last Name') !!}
				{!! Form::text('usr_lname',$user->usr_lname,['placeholder'=>'Last Name','required']) !!}
			</div>
			<div class="required field">
				{!! Form::label('email','Email') !!}
				<div class="ui icon input">
				{!! Form::email('email',$user->email,['placeholder'=>'Email','required']) !!}
				<i class="mail icon"></i>
				</div>
			</div>
		</div>
		<div class="three fields">
			<div class="field">
				{!! Form::label('address','Address') !!}
				{!! Form::text('address',$user->profile->address) !!}
			</div>
			<div class="field">
				{!! Form::label('city','City') !!}
				{!! Form::text('city',$user->profile->city) !!}
			</div>
			<div class="field">
				{!! Form::label('state','State') !!}
				{!! Form::select('states',$states,$user->profile->state,['class'=>'ui fluid dropdown']) !!}
			</div>
		</div>
		<div class="accordion">
			<div class="title">
				<i class="dropdown icon"></i>
				Alternate Emails
			</div>
			<div class="content">
				<div class="three fields">
					<div class="field">
						{!! Form::label('email1','Email 1') !!}
						{!! Form::text('email1',$user->profile->email1) !!}
					</div>
					<div class="field">
						{!! Form::label('email2','Email 2') !!}
						{!! Form::text('email2',$user->profile->email2) !!}
					</div>
					<div class="field">
						{!! Form::label('email3','Email 3') !!}
						{!! Form::text('email3',$user->profile->email3) !!}
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="title">
		<i class="dropdown icon"></i>
		What Are Your Interests?
	</div>
	<div class="content">
		<div class="three fields">
			<div class="field">
				{!! Form::label('interest','Interests') !!}
				{!! Form::text('interest',$user->profile->interest) !!}
			</div>
			<div class="field">
				{!! Form::label('f_books','Favorite Books') !!}
				{!! Form::text('f_books',$user->profile->f_books) !!}
			</div>
			<div class="field">
				{!! Form::label('f_movie','Favorite Movies') !!}
				{!! Form::text('f_movie',$user->profile->f_movie) !!}
			</div>
		</div>
		<div class="three fields">
			<div class="field">
				{!! Form::label('f_tv','Favorite TV Shows') !!}
				{!! Form::text('f_tv',$user->profile->f_tv) !!}
			</div>
			<div class="field">
				{!! Form::label('f_music','Favorite Music') !!}
				{!! Form::text('f_music',$user->profile->f_music) !!}
			</div>
			<div class="field">
				{!! Form::label('f_games','Favorite Games') !!}
				{!! Form::text('f_games',$user->profile->f_games) !!}
			</div>
		</div>
		<div class="two fields">
			<div class="field">
				{!! Form::label('f_sports','Favorite Sports') !!}
				{!! Form::text('f_sports',$user->profile->f_sports) !!}
			</div>
			<div class="field">
				{!! Form::label('add_info','Who am I') !!}
				{!! Form::text('add_info',$user->profile->add_info) !!}
			</div>
		</div>
	</div>
	<div class="title">
		<i class="dropdown icon"></i>
		Personal Information
	</div>
	<div class="content">
		<div>
			@if($user->profile->photo_url)
				<img class="ui small circular image" src="{{{url('images/users/avatars/'.$user->profile->photo_url)}}}">
			@else
				<i class="icon user"></i>
			@endif
		</div>
		<div class="field">
			{!! Form::label('photo_url','Upload Profile Picture') !!}
			{!! Form::file('photo_url') !!}
		</div>
		<div class="two fields">
			<div class="field">
				{!! Form::label('birth_day','Birthday') !!}
				{!! Form::text('birth_day',$user->profile->birth_day,['class'=>'birth_day datepick']) !!}
			</div>
			<div class="field">
				{!! Form::label('anniversary','Anniversary') !!}
				{!! Form::text('anniversary',$user->profile->anniversary,['class'=>'anniversary datepick']) !!}
			</div>
		</div>
	</div>
	<div class="title">
		<i class="dropdown icon"></i>
		Keep In Touch With DadsTie
	</div>
	<div class="content">
		<div class="two fields">
			<div class="field">
				{!! Form::label('aboutus','How did you heard about us') !!}
				{!! Form::select('aboutus',$reason,$user->profile->aboutus,['class'=>'ui fluid dropdown']) !!}
			</div>
			<div class="field">
				{!! Form::label('receive_updates','Do you wish to receive our newsletter?') !!}
				{!! Form::select('receive_updates',['Yes'=>'Yes','No'=>'No'],$user->profile->receive_updates) !!}
			</div>
		</div>
	</div>
</div>
<div class="ui error message">
	<div class="header">We noticed some issues</div>
</div>
{!! Form::submit('Update',['class'=>'ui submit button blue']) !!}
{!! Form::close() !!}
@endsection