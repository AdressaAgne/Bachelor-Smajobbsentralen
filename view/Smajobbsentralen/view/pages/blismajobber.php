<article>
	<div class="row">
	<h1>{{ $page->header }}</h1>
	<p>@format($page->content)</p>
	@form('', 'put')
	<br/>
	</div>
	<div class="row">
	   <h3>Generelt</h3>
		<div class="form-element col-6 col-s-12">
			<label> Fornavn 
				<input type="text" name="firstname" id="formFname"/>
				<span id="errorMsgFName" class="errorMsg"></span>
			</label>
			
		</div>
		<div class="form-element col-6 col-s-12">
			<label> Etternavn 
				<input type="text" name="lastname" id="formLname"/>
				<span id="errorMsgLName" class="errorMsg"></span>
			</label>
		</div>
		<div class="form-element col-6 col-s-12">
            <label> E-post 
				<input type="text" name="email" id="formEmail"/>
				<span id="errorMsgEmail" class="errorMsg"></span>
			</label>
		</div>
		<div class="form-element col-6 col-s-12">
			<label> Adresse
				<input type="text" name="address" id="formAddress"/>
				<span id="errorMsgAddress" class="errorMsg"></span>
			</label>
		</div>
		<div class="form-element col-6 col-s-12">
			<label> Fødselsdato
				<input type="date" name="date" id="formDob"/>
				<span id="errorMsgDob" class="errorMsg"></span>
			</label>
		</div>
	</div>
	<div class="row">
		<h3>Telefon</h3>
		<div class="form-element col-6 col-s-12">
			<label> Mobil
				<input type="text" name="mob" id="formMob"/>
				<span id="errorMsgMob" class="errorMsg"></span>
			</label>
		</div>
		<div class="form-element col-6 col-s-12">
			<label> Privat
				<input type="text" name="priv" id="formPriv"/>
				<span id="errorMsgPriv" class="errorMsg"></span>
			</label>
		</div>
	</div>
	<div class="row">
		<h3>Annet</h3>
		<div class="form-element col-6 col-s-12">
			<p>Disponerer du bil?</p>
			<div class="col-12">
				<input type="radio" name="car" id="caryes">
				<label class="radio-label" for="caryes">Ja</label><br>
			</div>
			<div class="col-12">
				<input type="radio" name="car" id="carno">
				<label class="radio-label" for="carno">Nei</label><br>
			</div>
		</div>
		<div class="form-element col-6 col-s-12">
			<p>Hengerfeste?</p>
			<div class="col-12">
				<input type="radio" name="hitch" id="hitchyes">
				<label class="radio-label" for="hitchyes">Ja</label><br>
			</div>
			<div class="col-12">
				<input type="radio" name="hitch" id="hitchno">
				<label class="radio-label" for="hitchno">Nei</label><br>
			</div>
		</div>
		<div class="form-element col-12">
			<p> Okkupasjon</p>
			<div class="col-12">
				<input type="radio" name="occupation" id="school">
				<label class="radio-label" for="school">Skoleelev</label><br>
			</div>
			<div class="col-12">
				<input type="radio" name="occupation" id="unemployed">
				<label class="radio-label" for="unemployed">Arbeidsledig</label><br>
			</div>
			<div class="col-12">
				<input type="radio" name="occupation" id="pensioner">
				<label class="radio-label" for="pensioner">Pensjonist</label><br>
			</div>
			<div class="col-12">
				<input type="radio" name="occupation" id="disabled">
				<label class="radio-label" for="disabled">Uføre</label><br>
			</div>
			<div class="col-12">
				<input type="radio" name="occupation" id="other">
				<label class="radio-label" for="other">Annet</label><br>
			</div>
		</div>
		<div class="form-element col-12">
			<p>Jeg kan jobbe med følgende</p>

			@foreach($class->categories() as $cat)
				<div class="col-6">
					<input type="checkbox" name="work[]" id="{{$cat['name']}}">
					<label class="checkbox" for="{{$cat['name']}}">{{ucfirst($cat['name'])}}</label>
				</div>
			@endforeach

		</div>
		<div class="form-element col-12">
			<label> Annen info
				<textarea type="text" name="otherinfo" rows="8"></textarea>

			</label>
		</div>
	</div>
	<div class="row">
		<div class="form-element col-8">
		<h3>Taushetserklæring:</h3>
			<input type="checkbox" name="silence" id="repair">
			<label class="checkbox" for="repair">Jeg godtar at opplysninger jeg får kjennskap til hos de jeg jobber for, ikke omtales til andre utenfor frivilligsentralen. Dette gjelder også etter at jeg slutter. Om avtalen brytes kan jeg ikke benyttes på oppdrag lengere.
			</label>
		</div>
		<div class="form-element col-12">
			<input type="submit" value="Send inn søknad">
		</div>

	</div>

	@formend()
</article>
@layout('layout.scripts')
<script src="{{$assets}}/js/applicationval.js"></script>