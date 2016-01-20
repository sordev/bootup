<nav class="navbar navbar-default">
  <div class="container-fluid">
	<!-- Brand and toggle get grouped for better mobile display -->
	<div class="navbar-header">
	  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
		<span class="sr-only">Нээх/Хаах</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	  </button>
	  <a class="navbar-brand" href="{{{url('/')}}}"><img alt="Bootup" src="{{{asset('images/logo.png')}}}"></a>
	</div>

	<!-- Collect the nav links, forms, and other content for toggling -->
	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	  <ul class="nav navbar-nav">
		@foreach($navigations['super'] as $n)
			@include('modules.navigations.item',['item'=>$n])
		@endforeach
	  </ul>
	  <form class="navbar-form navbar-left" role="search">
		<div class="form-group">
		  <input type="text" class="form-control" placeholder="Search">
		</div>
		<button type="submit" class="btn btn-default">Хайх</button>
	  </form>
	  @if(isset($navigations['user']))
	  <ul class="nav navbar-nav navbar-right">
		@foreach($navigations['user'] as $n)
			@include('modules.navigations.item',['item'=>$n])
		@endforeach
		@include('modules.modal',['title'=>'Нэвтрэх','id'=>'loginModal','modalbody'=>'modules.user.login'])
		@include('modules.modal',['title'=>'Бүртгүүлэх','id'=>'registerModal','modalbody'=>'modules.user.register'])
	  </ul>
	  @endif
	</div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>