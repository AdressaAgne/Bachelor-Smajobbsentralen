<div class="row">
    @if(!empty($page->header))
        <h1>{{$page->header}}</h1>
    @endif
    @if(!empty($page->content))
        <h2>{{$page->content}}</h2>
    @endif
</div>

@form('', 'put')

<div class="row">
    <div class="col-12">
        <div class="form-element col-6">
            <label>Navn:
                <input type="text" placeholder="Navn" name="name">
            </label>
        </div>
        
        <div class="form-element col-6">
            <label>Adresse:
                <input type="text" placeholder="Adresse" name="address">
            </label>
        </div>    
    </div>
    
    <div class="col-12">
        <div class="form-element col-6">
            <label>Privat Telefon:
                <input type="text" placeholder="Privat Telefon" name="private">
            </label>
        </div>
        
        <div class="form-element col-6">
            <label>Mobil Telefon:
                <input type="text" placeholder="Mobil Telefon" name="mobile">
            </label>
        </div>
    </div>
    
    <div class="col-12">
        <div class="form-element col-12">
            <label>Ytterlig Informasjon:
                <textarea name="info" rows="5"></textarea>
            </label>
        </div>
    </div>
    
    <div class="col-12">
        <div class="form-element col-12">
            <input type="submit" name="" value="Legg til kunde">
        </div>
    </div>
</div>
@formend()