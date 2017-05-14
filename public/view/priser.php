@layout('layout.head', ['title' => 'Småjobbsentralen'])
@layout('layout.telefonvakt_menu')
<div class="tlf-panel">
<!-- split up to åpningstider and arbeidstyper -->
<div class="row">
	<h1>Priser Og Telefon nummer</h1>
</div>


<div class="row">
	<div class="row">
        @form('', PATCH)
		    	
            @foreach($global->get_priser() as $key => $pris)
				<label>{{$pris['item']}}
					<input type="text" value="{{$pris['value']}}" name="value[]">
					<input type="hidden" value="{{$key}}" name="key[]">
				</label>
			@endforeach
                	
			<div class="form-element">
				<input type="submit" value="Lagre">
			</div>
			
        @formend()
		
    </div>
</div>
</div>
@layout('layout.foot')