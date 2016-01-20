@extends('layouts.default')

@section('sidebar')
    @parent
	<div class="ui vertical menu">
	  <div class="item">
		<div class="ui input"><input type="text" placeholder="Search..."></div>
	  </div>
	  <div class="item">
		Home
		<div class="menu">
		  <a class="active item">Search</a>
		  <a class="item">Add</a>
		  <a class="item">Remove</a>
		</div>
	  </div>
	  <a class="item">
		<i class="grid layout icon"></i> Browse
	  </a>
	  <a class="item">
		Messages
	  </a>
	  <div class="ui dropdown item">
		More
		<i class="dropdown icon"></i>
		<div class="menu">
		  <a class="item"><i class="edit icon"></i> Edit Profile</a>
		  <a class="item"><i class="globe icon"></i> Choose Language</a>
		  <a class="item"><i class="settings icon"></i> Account Settings</a>
		</div>
	  </div>
	</div>
    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')

	@if(isset($user))
		<div class="ui card">
		  <div class="image">
			@if($user->profile->photo_url)
				<img class="ui small circular image" src="{{{url('images/users/avatars/'.$user->profile->photo_url)}}}">
			@else
				<i class="icon user"></i>
			@endif
		  </div>
		  <div class="content">
			<a class="header">{!!$user->usr_fname!!} {!!$user->usr_mname!!} {!!$user->usr_lname!!}</a>
			<div class="meta">
			  <span class="date">Joined in {!!date('Y',strtotime($user->usr_ts))!!}</span>
			</div>
			<div class="meta">
			  <span class="date">{!!$user->email!!} </span>
			</div>
			@if($user->profile)
			<div class="meta">
			  <span>{!!$user->profile->gender!!} </span>
			</div>
			@endif
			<div class="description">
			  Kristy is an art director living in New York.
			</div>
		  </div>
		  <div class="extra content">
			<a>
			  <i class="user icon"></i>
			  22 Friends
			</a>
		  </div>
		</div>
	@else
		@include('errors.error',$error=['message'=>'User Not Found','description'=>"The user you're looking for not found"])
	@endif
	
@endsection