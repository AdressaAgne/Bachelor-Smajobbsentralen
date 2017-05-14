@layout('layout.head', ['title' => 'Småjobbsentralen'])
<div class="container">
<div class="row">
	@if(!empty($page->header))
		<h3>{{$page->header}}</h3>
	@endif
	@if(!empty($page->content))
		<h1>{{$page->content}}</h1>
	@endif
</div>

<div class="row">
	<div class="col-2 col-m-3" id="categories">
		@foreach($global->categories() as $cat)
			<button class="category" id="{{$cat['id']}}" value="{{$cat['name']}}"><i class="fa fa-lg fa-{{$cat['icon']}}"></i><br>{{$cat['name']}}</button>
		@endforeach
	</div>
	<div class="col-10 col-m-8">
		<div id="smajobbere">
			@foreach($smajobbere as $smajobber)
				<div class="row smajobbere-list">
					<div class="col-12">
						<h1>{{$smajobber->full_name()}}</h1>
						<h1><strong><i class="fa fa-phone"></i> {{$global->format_phonenr($smajobber->mobile_phone)}}</strong></h1>
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
		var _this = $(this);
		var smajobberId = $(this).attr("id");
		$("#smajobbere").fadeOut(50);
		loading.show();
		$.ajax({
			type: "POST",
			url: "/smajobbere",
			datatype : 'json',
			data: {
				'_method' : 'POST',
				'_token'  : '@csrf()',
				'_id' 	  : smajobberId
			},
			success : function(data){
				loading.hide();
				$("#smajobbere").html('');
				if(data.length > 0){
					$.each(data, function(i, item) {
						$("#smajobbere").prepend(
							"<div class='row smajobbere-list'>"+
								"<div class='col-12'>"+
									"<h1>"+item.name + " " + item.surname + "</h1>"+
									"<h1>"+"<strong><i class='fa fa-phone'></i> "+formatPhoneNr(item.mobil)+"</strong></h1>"+
								"</div>"+
							"</div>"
						).fadeIn(item);
					})
					$("#smajobbere").prepend("<h1 class='font-medium'>Følgende kan jobbe med \""+_this.find('i')[0].outerHTML+' '+_this.val()+"\"</h1>").fadeIn();
				}else{
					$("#smajobbere").append(
						"<h1 class='font-medium'>Det er dessverre ingen som kan gjøre arbeeid av typen \""+_this.find('i')[0].outerHTML+' '+_this.val()+"\"</h1>"
					).fadeIn();
				}


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
</div>
@layout('layout.foot')