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
		<div class="col-12">
			@foreach($class->calendar() as $cal)
				<div class="cal-1 {{$cal['class']}}">
					{{$cal['date']}}

				</div>
			@endforeach
		</div>
	</div>
