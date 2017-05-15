@layout('layout.head', ['title' => 'Småjobbsentralen'])
@layout('layout.telefonvakt_menu')
<div class="tlf-panel">
<!-- split up to åpningstider and arbeidstyper -->
<div class="row">
	<h1>Arbeidstyper</h1>
</div>

<div class="row">
	<div class="col-12">
		<div class="col-6 col-m-12">
			<div class="row">
				<h2 class="font-center">Alle arbeidstyper</h2>
			</div>
			<div class="row form-element--border">
			@foreach($global->categories() as $cat)
				<div class="col-12">
					<div class="form-element">
						<p class="category"><i class="fa fa-lg fa-{{$cat['icon']}}"></i> {{$cat['name']}}</p>
					</div>
					<div class="form-element form-element--right">
						<input type="button" value="Fjern" class="accent" id="{{$cat['id']}}">
					</div>
				</div>
			@endforeach
			</div>
		</div>

		<div class="col-6 col-m-12">
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
						<h2>Velg bilde</h2>
						<div class="col-12">
							<input class="radio" type="radio" name="arbeidstype_icon" id="icon-1" checked value="user">
							<label class="radio" for="icon-1"><i class="fa fa-lg fa-user"></i> Person</label><br>
						</div>
						
						<div class="col-12">
							<input class="radio" type="radio" name="arbeidstype_icon" id="icon-2" value="snowflake-o">
							<label class="radio" for="icon-2"><i class="fa fa-lg fa-snowflake-o"></i> Snøfnugg / Snømåking</label><br>
						</div>
						
						<div class="col-12">
							<input class="radio" type="radio" name="arbeidstype_icon" id="icon-3" value="car">
							<label class="radio" for="icon-3"><i class="fa fa-lg fa-car"></i> Bil / Kjøring</label><br>
						</div>
						
						<div class="col-12">
							<input class="radio" type="radio" name="arbeidstype_icon" id="icon-4" value="truck">
							<label class="radio" for="icon-4"><i class="fa fa-lg fa-truck"></i> Lastebil / Flytting</label><br>
						</div>
						
						<div class="col-12">
							<input class="radio" type="radio" name="arbeidstype_icon" id="icon-5" value="paint-brush">
							<label class="radio" for="icon-5"><i class="fa fa-lg fa-paint-brush"></i> Malekost / Maling</label><br>
						</div>
						
						<div class="col-12">
							<input class="radio" type="radio" name="arbeidstype_icon" id="icon-6" value="suitcase">
							<label class="radio" for="icon-6"><i class="fa fa-lg fa-suitcase"></i> Koffert / Møblering</label><br>
						</div>
						
						<div class="col-12">
							<input class="radio" type="radio" name="arbeidstype_icon" id="icon-7" value="leaf">
							<label class="radio" for="icon-7"><i class="fa fa-lg fa-leaf"></i> Blad / Hage</label><br>
						</div>
						
						<div class="col-12">
							<input class="radio" type="radio" name="arbeidstype_icon" id="icon-8" value="tree">
							<label class="radio" for="icon-8"><i class="fa fa-lg fa-tree"></i> Tre / Hage</label><br>
						</div>
						
						<div class="col-12">
							<input class="radio" type="radio" name="arbeidstype_icon" id="icon-9" value="wrench">
							<label class="radio" for="icon-9"><i class="fa fa-lg fa-wrench"></i> Skiftenøkkel / Småarbeid</label><br>
						</div>
						
						<div class="col-12">
							<input class="radio" type="radio" name="arbeidstype_icon" id="icon-10" value="shopping-cart">
							<label class="radio" for="icon-10"><i class="fa fa-lg fa-shopping-cart"></i> Vogn / Handling</label><br>
						</div>
						
						<div class="col-12">
							<input class="radio" type="radio" name="arbeidstype_icon" id="icon-11" value="shower">
							<label class="radio" for="icon-11"><i class="fa fa-lg fa-shower"></i> Vann / Vasking</label><br>
						</div>
						
						
					</div>
					<div class="form-element col-12">
						<input type="submit" class="" value="Legg til">
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
</div>
@layout('layout.foot')