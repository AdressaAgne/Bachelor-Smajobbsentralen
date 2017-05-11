@layout('layout.head', ['title' => 'Login'])
    
    <div class="container">
        <div class="row">
            @if(isset($info))
                <h1>{{$info}}</h1>
            @endif
        @form('', 'post')
            <div class="form-element col-12">
                <label>Brukernavn:
                    <input type="text" name="username" placeholder="Brukernavn">
                </label>
            </div>
            <div class="form-element col-12">
                <label>Passord:
                    <input type="password" name="password" placeholder="Passord">
                </label>
            </div>
            <div class="form-element col-12">
                <input type="checkbox" class="checkbox" id="rememberme">
                <label for="rememberme" class="checkbox">Husk Meg</label>
            </div>
            <div class="form-element col-12">
                <input type="submit" value="Login">
            </div>
        
        @formend()
        
        </div>
    </div>
    
@layout('layout.foot')