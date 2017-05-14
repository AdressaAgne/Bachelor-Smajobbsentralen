@layout('layout.head', ['title' => 'Bli Småjobber'])
<div class="container">
<article>
	<div class="row">
	<h1>Bli Småjobber</h1>
	@form('', 'put')
	</div>
	<div class="row">
	   <h3>Generelt</h3>
	   	@if(isset($error))
	   		<h1>{{$error}}</h1>
		@endif
	   	@if(isset($info))
	   		<h1 style="color: #00CE00">{{$info}}</h1>
		@else
		<div class="form-element col-6 col-s-12">
			<label> Fornavn 
				<input type="text" name="firstname" placeholder="Fornavn">
				<span class="errorMsg"></span>
			</label>
			
		</div>
		<div class="form-element col-6 col-s-12">
			<label> Etternavn 
				<input type="text" name="lastname" placeholder="Etternavn">
				<span class="errorMsg"></span>
			</label>
		</div>
		<div class="form-element col-6 col-s-12">
            <label> E-post 
				<input type="text" name="email" placeholder="E-post">
				<span class="errorMsg"></span>
			</label>
		</div>
		<div class="form-element col-6 col-s-12">
			<label> Adresse
				<input type="text" name="address" placeholder="Adresse" >
				<span class="errorMsg"></span>
			</label>
		</div>
		<div class="form-element col-6 col-s-12">
			<label> Fødselsår
				<input type="text" name="date" placeholder="Fødselsår" >
				<span id="errorMsgDob" class="errorMsg"></span>
			</label>
		</div>
	</div>
	<div class="row">
		<h3>Telefon</h3>
		<div class="form-element col-6 col-s-12">
			<label> Mobil Telefon
				<input type="text" name="mob" placeholder="Mobil">
				<span class="errorMsg"></span>
			</label>
		</div>
		<div class="form-element col-6 col-s-12">
			<label> Privat Telefon
				<input type="text" name="priv" placeholder="Privat Telefon">
			</label>
		</div>
	</div>
	<div class="row">
		<h3>Annet</h3>
		<div class="form-element col-6 col-s-12" id="hascar">
			<p>Disponerer du bil?</p>
			<div class="col-12">
				<input class="radio" type="radio" name="car" id="caryes" value="1">
				<label class="radio" for="caryes">Ja</label><br>
			</div>
			<div class="col-12">
				<input class="radio"  type="radio" name="car" id="carno" value="0">
				<label class="radio" for="carno">Nei</label><br>
			</div>
			<span id="errorMsgCar" class="errorMsg"></span>
		</div>
		<div class="form-element col-6 col-s-12" id="hashitch">
			<p>Hengerfeste?</p>
			<div class="col-12">
				<input class="radio"  type="radio" name="hitch" id="hitchyes" value="1">
				<label class="radio" for="hitchyes">Ja</label><br>
			</div>
			<div class="col-12">
				<input class="radio"  type="radio" name="hitch" id="hitchno" value="0">
				<label class="radio" for="hitchno">Nei</label><br>
			</div>
			<span id="errorMsgHitch" class="errorMsg"></span>
		</div>
		<div class="form-element col-12" id="hasocc">
			<p> Okkupasjon</p>
			<div class="col-12">
				<input class="radio"  type="radio" name="occupation" id="school" value="skoleelev">
				<label class="radio" for="school">Skoleelev</label><br>
			</div>
			<div class="col-12">
				<input class="radio"  type="radio" name="occupation" id="unemployed" value="unemployed">
				<label class="radio" for="unemployed">Arbeidsledig</label><br>
			</div>
			<div class="col-12">
				<input class="radio"  type="radio" name="occupation" id="pensioner" value="pensioner">
				<label class="radio" for="pensioner">Pensjonist</label><br>
			</div>
			<div class="col-12">
				<input class="radio"  type="radio" name="occupation" id="disabled" value="disabled">
				<label class="radio" for="disabled">Uføre</label><br>
			</div>
			<div class="col-12">
				<input class="radio"  type="radio" name="occupation" id="other" value="other">
				<label class="radio" for="other">Annet</label><br>
			</div>
			<span id="errorMsgOcc" class="errorMsg"></span>
		</div>
		<div class="form-element col-12" id="categories">
			<p>Jeg kan jobbe med følgende</p>

			@foreach($global->categories() as $cat)
				<div class="col-6">
					<input  class="checkbox" type="checkbox" name="work[]" id="{{$cat['name']}}" value="{{$cat['id']}}">
					<label class="checkbox" for="{{$cat['name']}}">{{ucfirst($cat['name'])}}</label>
				</div>
			@endforeach
            <span id="errorMsgCheck" class="errorMsg"></span>
		</div>
		<div class="form-element col-12">
			<label> Annen info
				<textarea type="text" name="otherinfo" rows="8"></textarea>

			</label>
		</div>
	</div>
	<div class="row">
		<div class="form-element col-8" id="conf">
		<h3>Taushetserklæring:</h3>
			<input class="checkbox" type="checkbox" name="silence" id="repair">
			<label class="checkbox" for="repair">Jeg godtar at opplysninger jeg får kjennskap til hos de jeg jobber for, ikke omtales til andre utenfor frivilligsentralen. Dette gjelder også etter at jeg slutter. Om avtalen brytes kan jeg ikke benyttes på oppdrag lengere.
			</label>
			<span id="errorMsgConf" class="errorMsg"></span>
		</div>
		<div class="form-element col-12">
			<input type="submit" value="Send inn søknad" name="_submit">
		</div>

	</div>
	@endif
	@formend()
</article>
@layout('layout.scripts')
<script src="{{$assets}}/js/applicationval.js"></script>
</div>
@layout('layout.foot')