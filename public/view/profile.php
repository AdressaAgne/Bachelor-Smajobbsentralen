@layout('layout.head', ['title' => 'Småjobbsentralen'])
@layout('layout.telefonvakt_menu')
<div class="tlf-panel">
<!-- split up to åpningstider and arbeidstyper -->
<div class="row">
	<h1>Din Profil</h1>
</div>
<div class="row">
    @form('', PATCH)
        <h3>{{$user->full_name()}}</h3>
		<small>brukernavn: {{$user->username}}</small>
        
        <div class="col-12">
            <h2>Endre passord</h2>
            <div class="form-element col-12">
                <label>
                    Nytt Passord:
                    <input type="password" name="pw1" placeholder="Nytt Passord" value="">
                </label>
            </div>
            <div class="form-element col-12">
                <label>
                    Nytt Passord igjen:
                    <input type="password" name="pw2" placeholder="Nytt Passord Igjen" value="">
                </label>
            </div>
        </div>
        <div class="form-element col-6">
            <input type="hidden" name="user_id" value="{{$user->id}}">
            <input type="submit" name="edit" value="Endre Passord">
        </div>
    @formend()
</div>
@form('', POST)
<div class="row">
    
    <div class="col-12">
        <h2>Endre din profil</h2>
    </div>
    <div class="form-element col-12">
        <input class="checkbox" type="checkbox" @checked($user->visible == 1) name="visible" id="visible-{{$user->id}}">
        <label class="checkbox" for="visible-{{$user->id}}">Synlig i søk</label>
    </div>


    <div class="form-element col-6 col-s-12">
        <label> Fornavn 
            <input type="text" name="firstname" placeholder="Fornavn" value="{{$user->name}}">
            <span class="errorMsg"></span>
        </label>
        
    </div>
    <div class="form-element col-6 col-s-12">
        <label> Etternavn 
            <input type="text" name="lastname" placeholder="Etternavn" value="{{$user->surname}}">
            <span class="errorMsg"></span>
        </label>
    </div>
    <div class="form-element col-6 col-s-12">
        <label> E-post 
            <input type="text" name="email" placeholder="E-post" value="{{$user->mail}}">
            <span class="errorMsg"></span>
        </label>
    </div>
    <div class="form-element col-6 col-s-12">
        <label> Adresse
            <input type="text" name="address" placeholder="Adresse"  value="{{$user->address}}">
            <span class="errorMsg"></span>
        </label>
    </div>
    <div class="form-element col-6 col-s-12">
        <label> Fødselsår
            <input type="text" name="date" placeholder="Fødselsår"  value="{{$user->dob}}">
            <span id="errorMsgDob" class="errorMsg"></span>
        </label>
    </div>
</div>
<div class="row">
    <h3>Telefon</h3>
    <div class="form-element col-6 col-s-12">
        <label> Mobiltelefon
            <input type="text" name="mob" placeholder="Mobiltelefon"  value="{{$user->mobile_phone}}">
            <span class="errorMsg"></span>
        </label>
    </div>
    <div class="form-element col-6 col-s-12">
        <label> Privattelefon
            <input type="text" name="priv" placeholder="Privattelefon"  value="{{$user->private_phone}}">
        </label>
    </div>
</div>
<div class="row">
    <h3>Annet</h3>
    <div class="form-element col-6 col-s-12" id="hascar">
        <p>Disponerer du bil?</p>
        <div class="col-12">
            <input class="radio" type="radio" name="car" id="caryes" @checked($user->car == 1) value="1">
            <label class="radio" for="caryes">Ja</label><br>
        </div>
        <div class="col-12">
            <input class="radio"  type="radio" name="car" id="carno" @checked($user->car == 0) value="0">
            <label class="radio" for="carno">Nei</label><br>
        </div>
        <span id="errorMsgCar" class="errorMsg"></span>
    </div>
    <div class="form-element col-6 col-s-12" id="hashitch">
        <p>Hvis ja, har bilen hengerfeste?</p>
        <div class="col-12">
            <input class="radio"  type="radio" name="hitch" id="hitchyes" @checked($user->hitch == 1) value="1">
            <label class="radio" for="hitchyes">Ja</label><br>
        </div>
        <div class="col-12">
            <input class="radio"  type="radio" name="hitch" id="hitchno" @checked($user->hitch == 0) value="0">
            <label class="radio" for="hitchno">Nei</label><br>
        </div>
        <span id="errorMsgHitch" class="errorMsg"></span>
    </div>
    <div class="form-element col-12" id="hasocc">
        <p> Okkupasjon</p>
        <div class="col-12">
            <input class="radio"  type="radio" name="occupation" id="school" @checked($user->occupation == 'Skoleelev') value="Skoleelev">
            <label class="radio" for="school">Skoleelev</label><br>
        </div>
        <div class="col-12">
            <input class="radio"  type="radio" name="occupation" id="unemployed" @checked($user->occupation == 'Arbeidsledig') value="Arbeidsledig">
            <label class="radio" for="unemployed">Arbeidsledig</label><br>
        </div>
        <div class="col-12">
            <input class="radio"  type="radio" name="occupation" id="pensioner" @checked($user->occupation == 'Pensjonist') value="Pensjonist">
            <label class="radio" for="pensioner">Pensjonist</label><br>
        </div>
        <div class="col-12">
            <input class="radio"  type="radio" name="occupation" id="disabled" @checked($user->occupation == 'Uføre') value="Uføre">
            <label class="radio" for="disabled">Uføre</label><br>
        </div>
        <div class="col-12">
            <input class="radio"  type="radio" name="occupation" id="other" @checked($user->occupation == 'Annet') value="Annet">
            <label class="radio" for="other">Annet</label><br>
        </div>
        <span id="errorMsgOcc" class="errorMsg"></span>
    </div>
    <div class="form-element col-12" id="categories">
        <p>Jeg kan jobbe med følgende</p>
        <?php $work = $user->get_work(); ?>
        @foreach($global->categories() as $cat)
            <?php $inArray = in_array($cat['name'], $work); ?>
            <div class="col-6">
                <input  class="checkbox" @checked($inArray)  type="checkbox" name="work[]" id="{{$cat['name']}}" value="{{$cat['id']}}">
                <label class="checkbox" for="{{$cat['name']}}">{{ucfirst($cat['name'])}}</label>
            </div>
        @endforeach
        <span id="errorMsgCheck" class="errorMsg"></span>
    </div>
    <div class="form-element col-12">
        <label> Annen info
            <textarea type="text" name="otherinfo" rows="8">{{$user->other_info}}</textarea>

        </label>
    </div>
</div>
<div class="row">
    <div class="form-element col-12">
        <input type="submit" value="Lagre din profil" name="_submit">
    </div>
</div>
@formend()
</div>
@layout('layout.foot')