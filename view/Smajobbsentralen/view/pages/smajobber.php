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

		<div class="row" id="loading" style="display:none;">
		  <label for="file" class="col--center" style="width: 150px;">
			  <svg height="150" width="150" class="pie-chart processing" id="svg">
				<circle class="behind"cx="50%" cy="50%" r="40%" />
				<circle class="front" cx="50%" cy="50%" r="40%" data-percent="0" />
			  </svg>
		  </label>
		</div>


		<div id="smajobbere">
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
</div>
@layout('layout.scripts')
<script>
	//Jquery for oppdatering av visningen av hvilke småjobbere som tar oppgitt oppdrag

	$("#categories .category").on("click", function(e){
		e.preventDefault();
		var smajobberId = $(this).attr("id");
		//console.log("cat id: " + smajobberId);
			$("#smajobbere").fadeOut(50);
			$('#loading').show();

		//legg til loading

		$.ajax({
			type: "POST",
			url: "",
			datatype : 'json',
			data: {
				'_method' : 'POST',
				'_token'  : '@csrf()',
				'_id' 	  : smajobberId
			},
			success : function(data){
				$('#loading').hide();
				//$("#smajobbere").html(data);
				//console.log(data);
				//$("#smajobbere").fadeIn(50);
				$("#smajobbere").html('');
				$.each(data, function(i, item) {
					$("#smajobbere").prepend(
						"<div class='row smajobbere-list'>"+
							"<div class='col-12'>"+
								"<h1>"+item.name + " " + item.surname + "</h1>"+
								"<h1>"+"<strong><i class='fa fa-phone'></i>"+formatPhoneNr(item.mobil)+"</strong></h1>"+
							"</div>"+
						"</div>"
					).fadeIn(item);
				})
			},
			error : function(){
			  console.log("request fail");
			}

		});//post req
	});//EL

	function formatPhoneNr(nr){
		return nr.replace(/(\d{3})(\d{2})(\d{3})/, '$1 $2 $3');
	}

</script>
