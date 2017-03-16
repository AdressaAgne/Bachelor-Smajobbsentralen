<nav class="nav nav--fixed">
  <div class="container">
	<ul class="nav--left ">
		<li class="nav__item"><a href="/">home</a></li><!-- legg inn logo TODO -->
		@foreach($menu as $item)
			<li class="nav__item"><a href="/page/{{ $item['permalink'] }}">{{ $item['header'] }}</a></li>
		@endforeach
	</ul>
	<ul class="nav--right">
		<li class="nav__item"><a href="/admin">Admin</a></li>
		<li class="nav__item"><a href=""><span class="liten">A</span>-A</a></li>
	</ul>
  </div>
</nav>
