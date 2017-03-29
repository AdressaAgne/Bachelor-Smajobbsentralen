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
		@form('', 'post')
			<div class="col-3 font-left">
				<input type="hidden" name="month" value="{{$class->month}}">
				<input type="hidden" name="year" value="{{$class->year}}">
				<button type="submit" id="prev" name="prev" class="btn"> <i class="fa fa-arrow-left"></i> Forrige måned</button>
			</div>

			<div class="col-6 font-center">{{$class->month_to_str($class->month)}} {{$class->year}}</div> <!-- TODO månednavn -->

			<div class="col-3 font-right">
				<button type="submit" id="next" name="next" class="btn">Neste måned <i class="fa fa-arrow-right"></i></button>
			</div>
		@formend()

		<div class="calendar-modal" style="display:none;"></div>

		<div class="col-12">
			@for($i = 1; $i < 8; $i++)
				<div class="cal-1 calendar calendar--header">
					{{$class->day_to_str($i)}}
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
@layout('layout.scripts')
	<script>
		$('.calendar').on('click', function(){
			$('.calendar-modal').fadeIn();
		});
	</script>
