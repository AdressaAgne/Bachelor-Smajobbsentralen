@layout('layout.head', ['title' => 'Småjobbsentralen'])
@layout('layout.telefonvakt_menu')
<div class="row">
    <h1>Faktura</h1>
    <h2>Lag en fakura for en kunde</h2>
</div>


<div class="row">
    
    @if(count($members) == 0)
        <h1>Ingen kunder enda</h1>
        <p><a href="{{$source}}/oppdragstaker/kunder">Legg til kunde</a></p>
    @endif
    
    @foreach($members as $kunde)
        <div class="col-12">
            <div class="col-12 smajobbere-list">
                <div class="info" id='kunde-info-{{$kunde->id}}'>
                    <h1>{{$kunde->name}}</h1>
                    <p>Telefon: {{$kunde->mobile_phone}}</p>
                    @if($kunde->private_phone != 0)
                    <p>Privat Telefon: {{$kunde->private_phone}}</p>
                    @endif
                    <p>Adresse: <address>{{$kunde->address}}</address></p>
                </div>
                <div class="col-12">
                    <h2>Oppdrag</h2>
                    <table id='kunde-priser-{{$kunde->id}}' style="width: 100%;">
                        <thead>
                            <tr>
                                <td>Dato:</td>
                                <td>Oppgave</td>
                                <td>Kilometer</td>
                                <td>Tid</td>
                                <td>Merknad</td>
                                <td>Pris</td>
                                <td></td>
                            </tr>
                        </thead>
                        
                        <?php $k_oppdrag = $kunde->get_oppdrag(); ?>
                        @foreach($k_oppdrag['oppdrag'] as $oppdrag)
                            
                            <tr>
                                <td>{{date('d/m/Y', $oppdrag['time'])}}</td>
                                <td><i class="fa fa-{{$oppdrag['icon']}}"></i> {{$oppdrag['name']}}</td>
                                <td>{{$oppdrag['km']}}</td>
                                <td>{{$oppdrag['tid']}}</td>
                                <td>{{$oppdrag['info']}}</td>
                                <td>{{$oppdrag['pris']}},-</td>
                                <td><button class="accent" data-id="{{$oppdrag['id']}}" id="delete-oppdrag-{{$oppdrag['id']}}">Slett</button></td>
                            </tr>
                        
                        @endforeach
                        
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Sum: </td>
                            <td>{{$k_oppdrag['total']}},-</td>
                            <td></td>
                        </tr>
                        
                    </table>
                    
                    
                </div>
                
                @form('', 'put')
                <div class="col-12">
                    <div class="form-element col-4 col-m-12">
                        <select name="cat_id" class="dropdown">
                            <option selected="" disabled="">Hva gjorde du?</option>
                            @foreach($global->categories() as $cat)
                                <option value="{{$cat['id']}}">{{$cat['name']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-element col-4 col-m-6">
                        <input type="checkbox" name="hitch" id="hitch-{{$kunde->name}}" class="checkbox">
                        <label for="hitch-{{$kunde->name}}" class="checkbox">Brukte du tilhenger?</label>
                    </div>
                    <div class="form-element col-4 col-m-6">    
                        <input type="checkbox" name="equipment" id="equipment-{{$kunde->name}}" class="checkbox">
                        <label for="equipment-{{$kunde->name}}" class="checkbox">brukte du egent utstyr?</label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-element col-6">
                        <label>Tid i minuter:
                            <input type="text" placeholder="minuter" name="time">
                        </label>
                    </div>
                    <div class="form-element col-6">
                        <label>Kilometer:
                            <input type="text" placeholder="Kilometer" name="km">
                        </label>
                    </div>
                    
                    <div class="form-element col-12">
                        <label>Annen Info:
                            <textarea name="info" cols="10"></textarea>
                        </label>
                    </div>
                    
                    <div class="form-element col-6">
                        <input type="hidden" name="for_user_id" value="{{$kunde->id}}">
                        <input type="submit" value="legg til oppdrag">
                    </div>
                </div>    
                @formend()
                
                
                <div class="form-element col-6">
                    <input type="submit" name="delete" data-id="{{$kunde->id}}" class="accent" value="Slett kunde">
                </div>
                
                <div class="form-element col-6">
                    <input type="submit" name="print" data-id="{{$kunde->id}}" value="Print ut faktura">
                </div>
                
                
            </div>
        </div>
    @endforeach
</div>
@layout('layout.scripts')
<script>
    
    $('[id^=delete-oppdrag-]').click(function() {
        var that = $(this);
        showDialog('Vil du slette dette oppdraget?', {
            Ja : function () {
                $.ajax({
                    url : "",
                    method : 'post',
                    data : {
                        '_method' : 'post',
                        '_token'  : '@csrf()',
                        'id' 	  : that.data("id")
                    },
                    success : function(data){
                        that.parent().parent().slideUp().remove();

                    },
                    error : function(){
                        showDialog('Vi klarte ikke å seltte oppdraget. prøv igjen senere', {ok : ''})
                    }
                });//ajax
            },
            Nei : function () {
                
            }
        });
    });
    
    $('input[name=print]').click(function(){
        newWin = window.open("");
        newWin.document.write($('#kunde-info-'+$(this).data('id'))[0].outerHTML);
        
        var priser = $('#kunde-priser-'+$(this).data('id')).clone();
        priser.find('button').parent().remove();
        newWin.document.write(priser[0].outerHTML);
        newWin.print();
        newWin.close();
    });
    
    $('input[name=delete]').click(function() {
        var that = $(this);
        showDialog('Vil du slette denne kunden?', {
            Ja : function () {
                $.ajax({
                    url : "",
                    method : 'post',
                    data : {
                        '_method' : 'delete',
                        '_token'  : '@csrf()',
                        'kunde_id' 	  : that.data("id")
                    },
                    success : function(data){
                        that.parent().parent().slideUp();

                    },
                    error : function(){
                        showDialog('Vi klarte ikke å fjerne kunden. prøv igjen senere', {ok : ''})
                    }
                });//ajax
            },
            Nei : function () {
                
            }
        });
    });
    
</script>
@layout('layout.foot')