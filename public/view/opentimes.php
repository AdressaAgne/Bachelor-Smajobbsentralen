@layout('layout.head', ['title' => 'Småjobbsentralen'])
@layout('layout.telefonvakt_menu')

<!-- split up to åpningstider and arbeidstyper -->
<div class="row">
	<h1>Åpingstider</h1>
</div>


<div class="row">
    <div class="col-12">
        <h3>Åpningstider</h3>
	</div>
	<div class="row">
        @form('', PATCH)
			@for($i = 1; $i < 8; $i++)
				<div class="cal-1 calendar calendar--header">
					{{$global->day_to_str($i)}}
				</div>
			@endfor
			@for($i = 1; $i < 8; $i++)
				@if(in_array($i, $global->get_open_days()))
					<div class="cal-1 calendar--active">
						<div class="form-element">
							<label>Fra kl:
								<input type="text" name="from[]" placeholder="00:00" value="{{$global->get_open($i)['from_time']}}">
							</label>
							<label>Til kl:
								<input type="text" name="to[]" placeholder="00:00" value="{{$global->get_open($i)['to_time']}}">
							</label>
						</div>
					</div>
				@else
					<div class="cal-1">
						<div class="form-element">
							<label>Fra kl:
								<input type="text" name="from[]" placeholder="00:00">
							</label>
							<label>Til kl:
								<input type="text" name="to[]" placeholder="00:00">
							</label>
						</div>
					</div>
				@endif
					
			@endfor
			
			<div class="form-element">
				<input type="submit" value="Lagre">
			</div>
			
        @formend()
		
		
		
    </div>
</div>

@layout('layout.foot')