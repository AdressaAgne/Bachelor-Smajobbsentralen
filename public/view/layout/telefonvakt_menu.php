<nav class="nav-tlfvakt">
	<ul>
		<li><a href="{{$source}}/profil">Din Profile</a></li>
		@if($user->type == 1 || $user->type == 3)
		<li class="header">Telefonvakt</li>
		<li><a href="{{$source}}/telefonvakt/brukere">Alle Brukere</a></li>
		<li class=""><a href="{{$source}}/telefonvakt">Telefonvakt Oversikt</a></li>
		<li><a href="{{$source}}/telefonvakt/smajobbere">Småjobbere</a></li>
		<li><a href="{{$source}}/telefonvakt/soknader">Søknader</a></li>
		<li><a href="{{$source}}/telefonvakt/opningstider">Åpningstider</a></li>
		<li><a href="{{$source}}/telefonvakt/arbeidstyper">Arbeidstyper</a></li>
		<li><a href="{{$source}}/telefonvakt/priser">Priser Og Telefon</a></li>
		@endif
		@if($user->type == 0 || $user->type == 3)
		<li class="header">Oppdragstaker</li>
		<li><a href="{{$source}}/oppdragstaker/kunder">Ny kunde</a></li>
		<li><a href="{{$source}}/oppdragstaker/faktura">Faktura</a></li>
		@endif
		<li><a href="{{$source}}/logout">Logg ut</a></li>
	</ul>
</nav>
<div class="row">{! $global->breadcrubs !}</div>
