@layout('layout.head', ['title' => 'Småjobbsentralen'])
@layout('layout.telefonvakt_menu')
<div class="tlf-panel">
<div class="row">
    <h1>Ny kunde</h1>
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
            <label>Privattelefon:
                <input type="text" placeholder="Privattelefon" name="private">
            </label>
        </div>
        
        <div class="form-element col-6">
            <label>Mobiltelefon:
                <input type="text" placeholder="Mobiltelefon" name="mobile">
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
</div>
@layout('layout.foot')