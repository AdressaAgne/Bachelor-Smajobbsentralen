<nav class="nav-tlfvakt">
	<ul>
		@if($user->type == 1 || $user->type == 3)
		<li class="header">Telefonvakt</li>
		<li class=""><a href="/page/telefonvakt">Telefonvakt Oversikt</a></li>
		<li><a href="#">Småjobbere</a></li>
		<li><a href="/page/applications">Søknader</a></li>
		<li><a href="/page/innstillinger">Instillinger</a></li>
		@endif
		@if($user->type == 0 || $user->type == 3)
		<li class="header">Oppdragstaker</li>
		<li><a href="/page/kunder">Kunder</a></li>
		<li><a href="/page/faktura">faktura</a></li>
		@endif
	</ul>
</nav>
