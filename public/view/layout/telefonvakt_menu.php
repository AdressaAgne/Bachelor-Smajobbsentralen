<nav class="nav-tlfvakt">
	<ul>
		@if($user->type == 1 || $user->type == 3)
		<li class="header">Telefonvakt</li>
		<li class=""><a href="{{$source}}/telefonvakt">Telefonvakt Oversikt</a></li>
		<li><a href="{{$source}}/telefonvakt/smajobbere">Småjobbere</a></li>
		<li><a href="{{$source}}/telefonvakt/soknader">Søknader</a></li>
		<li><a href="{{$source}}/telefonvakt/opningstider">Åpningstider</a></li>
		<li><a href="{{$source}}/telefonvakt/arbeidstyper">Arbeidstyper</a></li>
		@endif
		@if($user->type == 0 || $user->type == 3)
		<li class="header">Oppdragstaker</li>
		<li><a href="{{$source}}/oppdragstaker/kunder">Ny kunde</a></li>
		<li><a href="{{$source}}/oppdragstaker/faktura">Faktura</a></li>
		@endif
		<li><a href="{{$source}}/logout">Logg ut</a></li>
	</ul>
</nav>
