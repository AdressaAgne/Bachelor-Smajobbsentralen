<nav class="nav nav--fixed">
  <div class="container">
	<ul class="nav--left">
        <li class="nav__item--burger"><i class="fa fa-bars"></i> Meny</li>
		<li class="nav__item @active_page('')"><a href="{{$source}}/">Hjem</a></li>
		<li class="nav__item @active_page('smajobbere')"><a href="{{$source}}/smajobbere">Småjobbere</a></li>
		<li class="nav__item @active_page('blismajobber')"><a href="{{$source}}/blismajobber">Bli Småjobber</a></li>
		<li class="nav__item @active_page('om')"><a href="{{$source}}/om">Om Smajobbsentralen</a></li>
	</ul>
	<ul class="nav--right hidden-s">
        @if(isset($user))
		    <li class="nav__item"><a href="{{$source}}/admin">{{$user->name}}</a></li>
        @else    
            <li class="nav__item"><a href="{{$source}}/admin">Login</a></li>
        @endif
	</ul>
  </div>
</nav>