<nav class="nav nav--fixed">
  <div class="container">
	<ul class="nav--left">
        <li class="nav__item--burger">Meny</li>
		<li class="nav__item"><a href="{{$source}}/">Hjem</a></li>
		<li class="nav__item"><a href="{{$source}}/smajobbere">Småjobbere</a></li>
		<li class="nav__item"><a href="{{$source}}/blismajobber">Bli Småjobber</a></li>
		<li class="nav__item"><a href="{{$source}}/om">Om Smajobbsentralen</a></li>
	</ul>
	<ul class="nav--right">
        @if(isset($user))
		    <li class="nav__item"><a href="{{$source}}/admin">Admin</a></li>
        @else    
            <li class="nav__item"><a href="{{$source}}/admin">Login</a></li>
        @endif
	</ul>
  </div>
</nav>