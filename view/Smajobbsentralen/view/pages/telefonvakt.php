<div class="row">
	@if(!empty($page->header))
		<h3>{{$page->header}}</h3>
	@endif
	@if(!empty($page->content))
		<h1>{{$page->content}}</h1>
	@endif
</div>
@layout('layout.telefonvakt_menu')
<!-- TODO loop igjennom fra backend. Evt vurder table istedet -->
	<div class="row">
		<form action="">
			<div class="col-12">
				<div class="col-3 font-left">
					<button type="submit" id="prev" name="prev" class="btn"> <i class="fa fa-arrow-left"></i> Forrige måned</button>
				</div>

				<div class="col-6 font-center">Dis Måned</div> <!-- TODO månednavn -->

				<div class="col-3 font-right">
					<button type="submit" id="next" name="next" class="btn">Neste måned <i class="fa fa-arrow-right"></i></button>
				</div>
			</div>
		</form>
		<div class="col-12">
			@for($i = 1; $i < 8; $i++)
				<div class="cal-1 calendar calendar--header">
					{{$class->ISO_8601($i)}}
				</div>
			@endfor

			@foreach($class->calendar() as $cal)
				<div class="cal-1 calendar calendar--{{$cal['class']}}">
					<div class="calendar--date">{{$cal['date']}}</div>
					{{ isset($cal['work']['name']) ? $cal['work']['name'] : '' }}
				</div>
			@endforeach
		</div>
	</div>
