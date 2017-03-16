<div class="row">
	@if(!empty($page->header))
		<h3>{{$page->header}}</h3>
	@endif
	@if(!empty($page->content))
		<h1>{{$page->content}}</h1>
	@endif
</div>

<div class="row">
	<div class="col-2">
		@foreach($class->get_cats() as $cat)

			<button class="col-12">{{$cat['name']}}</button>

		@endforeach
	</div>
	<div class="col-10">
		@foreach($class->get_smajobbere() as $smajobber)
		<div class="row smajobbere-list">
			<div class="col-12">
				<h1>{{$smajobber['name']}} {{$smajobber['surname']}}</h1>
				<h1><strong><i class="fa fa-phone"></i> {{$class->format_phonenr($smajobber['mobile_phone'])}}</strong></h1>
			</div>
		</div>
		@endforeach
	</div>
</div>
