@layout('layout.head', ['title' => 'Småjobbsentralen'])
@layout('layout.telefonvakt_menu')

<!-- split up to åpningstider and arbeidstyper -->
<div class="row">
	<h1>Brukere</h1>
</div>


<div class="row">
	<div class="row">
        
		    	
            @foreach($brukere as $key => $bruker)
                <div class="row">
    			    @form('', PATCH)
                        <h3>{{$bruker->full_name()}}
                            <small>brukernavn: {{$bruker->username}}</small>
                        </h3>
                        
                        <div class="col-12">
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
                        <div class="form-element col-6">
                            <input class="checkbox" type="checkbox" @checked($bruker->type == 1 || $bruker->type == 3) name="tlfvakt" id="tlfvakt-{{$bruker->id}}">
                            <label class="checkbox" for="tlfvakt-{{$bruker->id}}">Telefonvakt</label>
                        </div>
                        <div class="form-element col-6">
                            <input class="checkbox" type="checkbox" @checked($bruker->type == 0 || $bruker->type == 3) name="smajobber" id="smajobber-{{$bruker->id}}">
                            <label class="checkbox" for="smajobber-{{$bruker->id}}">Småjobber</label>
                        </div>
                        <div class="form-element col-6">
                            <input class="checkbox" type="checkbox" @checked($bruker->visible == 1) name="visible" id="visible-{{$bruker->id}}">
                            <label class="checkbox" for="visible-{{$bruker->id}}">Synlig i søk</label>
                        </div>
                        </div>

                        <div class="form-element col-6">
                            <input type="hidden" name="user_id" value="{{$bruker->id}}">
                            <input type="submit" name="edit" value="Endre Passord Og Rettigheter">
                        </div>
                    @formend()
                    <div class="form-element col-6">
                        <input type="button" name="delete" data-id="{{$bruker->id}}" class="danger" value="Slett {{$bruker->full_name()}}">
                    </div>
                </div>
			@endforeach
                	
			
			
        
		
    </div>
</div>
@layout('layout.scripts')
<script>
    
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
                    'user_id' 	  : that.data("id")
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