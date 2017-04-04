

<div class="row">
    @if(!empty($page->header))
        <h1>{{$page->header}}</h1>
    @endif
    @if(!empty($page->content))
        <h2>{{$page->content}}</h2>
    @endif
</div>


<div class="row">
    
    @if(count($class->get_kunder()) == 0)
        <h1>Ingen kunder enda</h1>
        <p><a href="{{$source}}/page/kunder">Legg til kunde</a></p>
    @endif
    
    @foreach($class->get_kunder() as $kunde)
        <div class="col-12">
            <div class="col-12 smajobbere-list">
                
                <h1>{{$kunde->name}}</h1>
                <p>Telefon: {{$kunde->mobile_phone}}</p>
                @if($kunde->private_phone != 0)
                <p>Privat: {{$kunde->private_phone}}</p>
                @endif
                <p>Address: <address>{{$kunde->address}}</address></p>
                
                <div class="col-12">
                    <h2>Oppdrag</h2>
                    <table>
                        <thead>
                            <tr>
                                <td>Dato:</td>
                                <td>Oppgave</td>
                                <td>Kilometer</td>
                                <td>Tid</td>
                                <td>Merknad</td>
                            </tr>
                        </thead>
                        @foreach($class->get_oppdrag($kunde->id) as $oppdrag)
                            
                            <tr>
                                <td>{{$oppdrag['time']}}</td>
                                <td>{{$oppdrag['name']}}</td>
                                <td>{{$oppdrag['km']}}</td>
                                <td>{{$oppdrag['tid']}}</td>
                                <td>{{$oppdrag['info']}}</td>
                            </tr>
                        
                        @endforeach
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
                        <input type="checkbox" name="hitch" id="hitch" class="checkbox">
                        <label for="hitch" class="checkbox">Brukte du tilhenger?</label>
                    </div>
                    <div class="form-element col-4 col-m-6">    
                        <input type="checkbox" name="equipment" id="equipment" class="checkbox">
                        <label for="equipment" class="checkbox">brukte du egent utstryt?</label>
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
                
                @form('', 'post')
                    <input type="hidden" name="kunde_id" value="{{$kunde->id}}">
                    <div class="form-element col-6">
                        <input type="submit" class="accent" value="Slett kunde">
                    </div>
                @formend()
                
            </div>
        </div>
    @endforeach
</div>