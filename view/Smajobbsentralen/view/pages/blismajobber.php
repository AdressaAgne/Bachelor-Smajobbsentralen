<article>
    <div class="row">
    <h1>{{ $page->header }}</h1>
    <p>@format($page->content)</p>
    @form("put")
    <br/>
    </div>
    <div class="row">
       <h3>Generelt</h3>
        <div class="form-element col-6 col-s-12">
            <label> Fornavn
                <input type="text" name="firstname"/>
            </label>
        </div>
        <div class="form-element col-6 col-s-12">
            <label> Etternavn
                <input type="text" name="lastname"/>
            </label>
        </div>
        <div class="form-element col-6 col-s-12">
            <label> E-post
                <input type="text" name="email"/>
            </label>
        </div>
        <div class="form-element col-6 col-s-12">
            <label> Adresse
                <input type="text" name="adress"/>
            </label>
        </div>
        <div class="form-element col-6 col-s-12">
            <label> Fødselsdato
                <input type="date" name="dob"/>
            </label>
        </div>
    </div>
    <div class="row">
        <h3>Telefon</h3>
        <div class="form-element col-6 col-s-12">
            <label> Mobil
                <input type="text" name="mobile"/>
            </label>
        </div>
        <div class="form-element col-6 col-s-12">
            <label> Privat
                <input type="text" name="private"/>
            </label>
        </div>
    </div>
    <div class="row">
        <h3>Annet</h3>
        <div class="form-element col-6 col-s-12">
            <label> Disponerer bil?
                <input type="radio" name="car" value="yes"> Ja<br>
                <input type="radio" name="car" value="no"> Nei<br>
            </label>
        </div>
        <div class="form-element col-6 col-s-12">
            <label> Hengerfeste?
                <input type="radio" name="hitch" value="yes"> Ja<br>
                <input type="radio" name="hitch" value="no"> Nei<br>
            </label>
        </div>
        <div class="form-element col-12">
            <label> Okkupasjon
                <input type="radio" name="occupation" value="school"> Skoleelev<br>
                <input type="radio" name="occupation" value="unemployed"> Arbeidsledig<br>
                <input type="radio" name="occupation" value="pensioner"> Pensjonist<br>
                <input type="radio" name="occupation" value="disabled"> Uføre<br>
                <input type="radio" name="occupation" value="other"> Annet<br>
            </label>
        </div>
        <div class="form-element col-12">
            <label> Jeg kan jobbe med følgende</label>
            <input type="checkbox" name="work[]" id="repair">
            <label class="checkbox" for="repair">Småreparasjoner</label><br>
            
            <input type="checkbox" name="work[]" id="driving">
            <label class="checkbox" for="driving">Kjøreoppdrag</label><br>
            
            <input type="checkbox" name="work[]" id="housework">
            <label class="checkbox" for="housework">Husarbeid</label><br>
            
            <input type="checkbox" name="work[]" id="gardenwork">
            <label class="checkbox" for="gardenwork">Hagearbeid</label><br>
            
            <input type="checkbox" name="work[]" id="showeling"> 
            <label class="checkbox" for="showeling">Snømåking</label><br>
            
            <input type="checkbox" name="work[]" id="mowing"> 
            <label class="checkbox" for="mowing">Gressklipping</label><br>
            
            <input type="checkbox" name="work[]" id="painting">
            <label class="checkbox" for="painting">Mindre malearbeid</label><br>
            
            <input type="checkbox" name="work[]" id="moving">
            <label class="checkbox" for="moving">Flytting</label><br>
            
            <input type="checkbox" name="work[]" id="rearranging"> 
            <label class="checkbox" for="rearranging">Ommøblering</label><br>
            
            <input type="checkbox" name="work[]" id="other">
            <label class="checkbox" for="other">Annet</label><br>
            
        </div>
        <div class="form-element col-12">
            <label> Annen info
                <textarea type="text" name="otherinfo" rows="8"></textarea>
                
            </label>
        </div>
    </div>
    <div class="row">
        <div class="form-element col-12">
        <label> Taushetserklæring
            <input type="checkbox" name="work[]" value="repair"> Jeg godtar at opplysninger jeg får kjennskap til hos de jeg jobber for, ikke omtales til andre utenfor frivilligsentralen. Dette gjelder også etter at jeg slutter. Om avtalen brytes kan jeg ikke benyttes på oppdrag lengere.<br>
        </label>    
        </div>
        <div class="form-element">
            <label>
                <input type="submit" value="Send inn søknad">
            </label>
        </div>
        
    </div>
        
    @formend()
</article>