<nav class="nav-tlfvakt">
	<ul>
		@if($user->type == 1 || $user->type == 3)
		<li class="header">Telefonvakt</li>
		<li class=""><a href="{{$source}}/telefonvakt">Telefonvakt Oversikt</a></li>
		<li><a href="#">Småjobbere</a></li>
		<li><a href="{{$source}}/soknader">Søknader</a></li>
		<li><a href="{{$source}}/opningstider">Åpningstider</a></li>
		<li><a href="{{$source}}/arbeidstyper">Arbeidstyper</a></li>
		@endif
		@if($user->type == 0 || $user->type == 3)
		<li class="header">Oppdragstaker</li>
		<li><a href="{{$source}}/kunder">Kunder</a></li>
		<li><a href="{{$source}}/faktura">faktura</a></li>
		@endif
		<li><a href="{{$source}}/logout">Logg ut</a></li>
	</ul>
</nav>
