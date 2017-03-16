<article>
    <h3>{{ $page->header }}</h3>
    <p>@format($page->content)</p>
    @form("put")
    <div class="row">
       <h2>Generelt</h2>
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
        <h2>Telefon</h2>
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
        <h2>Annet</h2>
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
            <label> Jeg kan jobbe med følgende
                <input type="checkbox" name="work[]" value="repair"> Småreparasjoner<br>
                <input type="checkbox" name="work[]" value="driving"> Kjøreoppdrag<br>
                <input type="checkbox" name="work[]" value="housework"> Husarbeid<br>
                <input type="checkbox" name="work[]" value="gardenwork"> Hagearbeid<br>
                <input type="checkbox" name="work[]" value="showeling"> Snømåking<br>
                <input type="checkbox" name="work[]" value="mowing"> Gressklipping<br>
                <input type="checkbox" name="work[]" value="painting"> Mindre malearbeid<br>
                <input type="checkbox" name="work[]" value="moving"> Flytting<br>
                <input type="checkbox" name="work[]" value="rearranging"> Ommøblering<br>
                <input type="checkbox" name="work[]" value="other"> Annet<br>
            </label>
        </div>
        <div class="form-element col-12">
            <label> Annen info
                <textarea type="text" name="otherinfo" rows="8"></textarea>
                
            </label>
            <span>Taushetserklæring: Det innebærer at opplysninger jeg får kjennskap til hos de jeg jobber for, ikke omtaler til andre utenfor frivilligsentralen. Dette gjelder også etter at jeg slutter. Om avtalen brytes kan jeg ikke benyttes på oppdrag lengere.</span>
        </div>
        
        <div class="form-element">
            <label>
                <input type="submit" value="Send inn søknad">
            </label>
        </div>
        
    </div>
        
    @formend()
</article>