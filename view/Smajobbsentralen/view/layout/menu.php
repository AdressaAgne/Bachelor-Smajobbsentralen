<nav class="nav nav--fixed">
  <div class="container">
	<ul class="nav--left ">
		<li class="nav__item"><a href="/">home</a></li><!-- legg inn logo TODO --> 
		@foreach($menu as $item)
			<li><a href="/page/{{ $item['permalink'] }}">{{ $item['header'] }}</a></li>
		@endforeach
	</ul>
  </div>
</nav>
