	</div><!-- /container-fluid -->
	<footer>
		<div class="row">
			<div class="container">
				<div class="col-12">
					<?php $open = $global->opentimes(); ?>
					<h3>Telefon</h3>
					<h1 class="vakttlf"><strong><i class="fa fa-phone"></i> 61 10 95 50</strong></h1>
					
					<h4><strong>Åpningstider:</strong> {{$open['isOpen']}} nå</h4>
					@foreach($open['timeStr'] as $str)
                        <p>{{ $str }}</p>
                    @endforeach
					<h4>Adresse:</h4>
					<p>Øvre Torvgate 2</p>
					<p>2815 Gjøvik</p>
				</div>
			</div>
		</div>
	</footer>
</body>
</html>
