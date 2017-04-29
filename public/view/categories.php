@layout('layout.head', ['title' => 'Småjobbsentralen'])
@layout('layout.telefonvakt_menu')

<!-- split up to åpningstider and arbeidstyper -->
<div class="row">
	<h1>Arbeidstyper</h1>
</div>

<div class="row">
	<div class="col-12">
		<div class="col-6">
			<div class="row">
				<h2 class="font-center">Arbeidstyper</h2>
			</div>
			<div class="row form-element--border">
			@foreach($global->categories() as $cat)
				<div class="col-12">
					<div class="form-element">
						<p>{{$cat['name']}}</p>
					</div>
					<div class="form-element form-element--right">
						<input type="button" value="Fjern" class="accent" id="{{$cat['id']}}">
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
				@form('', 'put')
				<div class="col-12">
					<div class="form-element col-12">
						<label>Skriv inn ønsket navn
							<input type="text" name="name" placeholder="Skriv inn ønsket navn">
						</label>
					</div>
					<div class="form-element col-12">
						<input type="submit" class="" value="legg til">
					</div>
				</div>
				@formend()
			</div>
		</div>
	</div>
</div>

@layout('layout.scripts')
<script>
	$("input[value=Fjern]").on("click", function(){

		var id = $(this).attr("id");
		var _this = $(this).parent().parent();

		showDialog('Er du sikker på at du vil fjerne denne arbeidstypen?', {
			Ja : function(){
					$.post({
						method : 'post',
						url: "",
						data: {
							'_method' : 'DELETE',
							'_token'  : '@csrf()',
							'id' 	  : id
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
@layout('layout.foot')