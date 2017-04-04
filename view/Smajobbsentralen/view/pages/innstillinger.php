<div class="row">
	@if(!empty($page->header))
		<h3>{{$page->header}}</h3>
	@endif
</div>
@layout('layout.telefonvakt_menu')
<div class="row">
    <div class="col-12">
        <h1>Åpningstider</h1>
        @form('', 'POST')
            @for($i = 0; $i < 7; $i++)
            <div class="col-2">
                <div class="form-element" style="margin-top: 35px;"> <!-- test TODO -->
                    <input class="checkbox" type="checkbox" id="{{$global->ISO_8601($i)}}" name="{{$global->ISO_8601($i)}}">
                    <label class="checkbox" for="{{$global->ISO_8601($i)}}">{{$global->ISO_8601($i)}}</label>
                </div>
            </div>
			<div class="col-4">
				<div class="form-element">
					Fra kl: <input type="text">
				</div>
			</div>
			<div class="col-4">
				<div class="form-element">
					Til kl: <input type="text">
				</div>
			</div>
			<div class="col-12"></div>
            @endfor
        @formend()
    </div>
</div>
<hr>

<div class="row">
	<div class="col-6 tlfvaktArbeid">
		<h2 class="font-center">Arbeidstyper</h2>
		@foreach($class->getArbeidstyper() as $arbType)
		<div class="col-12 tlfvaktArbeid-type">
			<div class="col-10">
				<p>{{$arbType['name']}}</p>
			</div>
			<div class="col-2">
				<input type="button" value="fjern" class="fjernArbeidstype btn" id="{{$arbType['id']}}">
			</div>
		</div>
		@endforeach
	</div>
	<div class="col-1"></div>
	<div class="col-5 tlfvaktArbeid">
		<h2 class="font-center">Legg til arbeidstype</h2>
		<div class="col-8 tlfvaktArbeid-leggtil">
			<input type="text" placeholder="skriv inn ønsket navn">
		</div>
		<div class="col-4  tlfvaktArbeid-leggtil">
			<input type="button" class="" value="legg til">
		</div>
	</div>
</div>

@layout('layout.scripts')

<script>
	$(".fjernArbeidstype").on("click", function(){
		var id = $(this).attr("id");

		//console.log($(this).attr("id"));

    	$.post({
			type: "POST",
			url: "",
			data: {
				'_method' : 'POST',
				'_token'  : '@csrf()',
				'_id' 	  : id
			},
			success : function(){
				console.log("woohoo");
				$(this).parent().parent().slideUp();
			},
			error : function(){
				alert("noe gikk dessverre galt under fjerning av arbeidstype. Prøv igjen senere");
				console.log("fail");
			}
		});
	});
</script>
