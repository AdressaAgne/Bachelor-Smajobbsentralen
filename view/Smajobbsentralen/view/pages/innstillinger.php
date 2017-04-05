@layout('layout.telefonvakt_menu')


@if(!empty($page->header))
	<div class="row">
		<h1>{{$page->header}}</h1>
		<h2>{{$page->content}}</h2>
	</div>
@endif


<div class="row">
    <div class="col-12">
        <h3>Åpningstider</h3>
	</div>
	<div class="row">
        @form('', 'POST')
			@for($i = 1; $i < 8; $i++)
				<div class="cal-1 calendar calendar--header">
					{{$global->day_to_str($i)}}
				</div>
			@endfor
			@for($i = 1; $i < 8; $i++)
				@if(in_array($i, $class->get_open_days()))
					<div class="cal-1 calendar calendar--active">
				@else
					<div class="cal-1 calendar">
				@endif
					<div class="form-element">
						<label>Fra kl: 
							<input type="text" name="from[]" placeholder="00:00">	
						</label>
						<label>Til kl: 
							<input type="text" name="to[]" placeholder="00:00">	
						</label>
					</div>
				</div>
			@endfor
        @formend()
    </div>
</div>


<div class="row">
	<div class="col-6">
		<div class="row">
			<h2 class="font-center">Arbeidstyper</h2>
		</div>
		<div class="row form-element--border">
		@foreach($class->getArbeidstyper() as $arbType)
			<div class="col-12">
				<div class="form-element">
					<p>{{$arbType['name']}}</p>
				</div>
				<div class="form-element form-element--right">
					<input type="button" value="Fjern" class="accent" id="{{$arbType['id']}}">
				</div>
			</div>
		@endforeach
		</div>
	</div>

	<div class="col-6">
		<div class="row">
			<h2 class="font-center">Legg til arbeidstype</h2>
		</div>
		<div class="row form-element--border">
			<div class="col-12">
				<div class="form-element col-12">
					<label>Skriv inn ønsket navn
						<input type="text" placeholder="Skriv inn ønsket navn">
					</label>
				</div>
				<div class="form-element col-12">
					<input type="button" class="" value="legg til">
				</div>
			</div>
		</div>
	</div>
</div>

@layout('layout.scripts')
@layout('layout.dialog')
<script>
	$("input[value=Fjern]").on("click", function(){

		var id = $(this).attr("id");
		var _this = $(this).parent().parent();
		
		showDialog('Er du sikker på at du vil fjerne denne arbeidstypen?', {
			Ja : function(){
					$.post({
						type: "POST",
						url: "",
						data: {
							'_method' : 'POST',
							'_token'  : '@csrf()',
							'_id' 	  : id
						},
						success : function(){
							_this.slideUp();
						},
						error : function(){
							showDialog('noe gikk dessverre galt under fjerning av arbeidstype. Prøv igjen senere', {ok : ''})
							console.log("fail");
						}
					});//ajax
			},
			Nei : function(){
				
			}
		});
	});//eventlistener
</script>
