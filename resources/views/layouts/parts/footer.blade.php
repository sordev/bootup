<div class="footer-wide">
	<div class="container">
		<footer>
			<div class="row">
				<div class="col-md-3">
					<img src="{{{asset('images/logo-white.png')}}}" alt="Bootup">
				</div>
				<div class="col-md-3">
					<h4>Бидний тухай</h4>
					@if(isset($navigations['about']))
						<ul>
							@foreach($navigations['about'] as $n)
								<li>
									<a href="{{{$n['url']}}}" title="{{{$n['title']}}}">
										{{{$n['title']}}}
									</a>
								</li>
							@endforeach
						</ul>
					@endif
				</div>
				<div class="col-md-3">
					<h4>Тусламж</h4>
					@if(isset($navigations['help']))
						<ul>
							@foreach($navigations['help'] as $n)
								<li>
									<a href="{{{$n['url']}}}" title="{{{$n['title']}}}">
										{{{$n['title']}}}
									</a>
								</li>
							@endforeach
						</ul>
					@endif
				</div>
				<div class="col-md-3">
					<h4>Ангилал</h4>
					@if(isset($navigations['categories']))
						<ul>
							@foreach($navigations['categories'] as $n)
								<li>
									<a href="{{{$n['url']}}}" title="{{{$n['title']}}}">
										{{{$n['title']}}}
									</a>
								</li>
							@endforeach
						</ul>
					@endif
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-md-6">
				Зохиогчийн эрх олон улсын хуулиар хамгаалагдсан &copy; 2015 - {{{date('Y')}}}
				@yield('footer')
				</div>
				<div class="col-md-6 text-right">
					<ul>
					</ul>
				</div>
			</div>
		</footer>
	</div>
</div>