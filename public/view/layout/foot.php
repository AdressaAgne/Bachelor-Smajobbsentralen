<script>
    var menu = document.querySelector('.nav');
	document.querySelector('.nav__item--burger').addEventListener('click', function(){
		var classes = menu.className.split(' ');
		if(classes.indexOf('active') < 0){
			calsses = classes.push('active');
		} else {
			classes.splice(classes.indexOf('active'), 1);
		}
		menu.className = classes.join(' ');
	});
</script>

	<footer>
		<div class="row">
			<div class="container">
				<div class="col-12">
					<?php $open = $global->opentimes(); ?>
					<h3>Telefon</h3>
					<h1 class="vakttlf"><strong><i class="fa fa-phone"></i> <a href="tel:{{$global->get_priser()['tlf']['value']}}">{{$global->get_priser()['tlf']['value']}}</a></strong></h1>
					
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
