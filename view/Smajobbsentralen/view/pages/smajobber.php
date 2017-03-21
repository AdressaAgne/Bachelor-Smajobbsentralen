<div class="row">
	@if(!empty($page->header))
		<h3>{{$page->header}}</h3>
	@endif
	@if(!empty($page->content))
		<h1>{{$page->content}}</h1>
	@endif
</div>

<div class="row">
	<div class="col-2" id="categories">
		@foreach($class->get_cats() as $cat)

			<button class="col-12 category" id="{{$cat['id']}}">{{$cat['name']}}</button>

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
@layout('layout.scripts')
<script>
	//Jquery for oppdatering av visningen av hvilke småjobbere som tar oppgitt oppdrag

	$("#categories .category").on("click", function(e){
		e.preventDefault();
		var _this = $(this);
		console.log("cat id: " + $(this).attr("id"));

		//legg til loading

		$.post({
			url: "smajobbere/sort",
			data : {
				_method : 'POST',
				_token : '@csrf()',
			},
			success : function(data){

			},
			error : function(){
			  console.log("request fail");
			}

		});//post req
	});//EL

</script>
