@layout('layout.head', ['title' => 'Småjobbsentralen'])
@layout('layout.telefonvakt_menu')
<div class="row">
    <h1>Søknader</h1>
    <h2>Søknader for å bli småjobber</h2>
</div>

<div class="row">
@if(count($applications) < 1)
    <h1>Ingen nye søknader</h1>
@endif
@foreach($applications as $user)
    <div class="col-8">
        <div class="col-12 smajobbere-list">
            <h1>{{$user->name}} {{$user->surname}}</h1>

            <p>
                <strong>Informasjon</strong>
                <ul>
                    <li>Mobil: {{$user->mobile_phone}}</li>
                    @if($user->private_phone != 0)
                    <li>Privat: {{$user->private_phone}}</li>
                    @endif
                    <li>E-post: {{$user->mail}}</li>
                    <li>Adresse: {{$user->address}}</li>
                    <li>Født: {{$user->dob}}</li>
                    <li>Alder: {{$global->get_age($user->dob)}}</li>
                    <li>Okkupasjon: {{$user->occupation}}</li>
                </ul>
            </p>
            <p>
                <strong>Kan jobbe med: </strong> {{ implode(', ', $user->get_work()) }}
            </p>
            <p>
                <strong>annen info:</strong>
                {{$user->other_info}}
            </p>

            <div class="col-6">
                <input type="hidden" name="user_id" value="{{$user->id}}">
                <input type="submit" value="Aksepter" class="accept" data-id="{{$user->id}}">
            </div>

            <div class="col-6">
                <input type="hidden" name="user_id" value="{{$user->id}}">
                <input type="submit" value="Avslå" data-id="{{$user->id}}" class="decline btn danger">
            </div>

        </div>

    </div>
@endforeach
</div>
@layout('layout.scripts')

<script>
    $(".accept").on("click", function(){
        var _this = $(this);
        var thisUser = $(this).parent().parent();
        console.log(_this.data("id"));

        showDialog("Er du sikker på at du vil ta imot denne brukeren?", {
            ja : function(){

                $.ajax({
                    url : "",
                    method : 'post',
                    data : {
                        '_method' : 'patch',
                        '_token'  : '@csrf()',
                        'user_id' 	  : _this.data("id")
                    },
                    success : function(data){
                        console.log(data);
                        thisUser.slideUp();
                    },
                    error : function(){
                        showDialog('Vi klarte ikke å akseptere brukeren. prøv igjen senere', {ok : ''})
                    }
                });//ajax
            },
            nei : function(){
                
            }
        });//dialog
    });//event accept




    $(".decline").on("click", function(){
        var _this = $(this);
        var thisUser = $(this).parent().parent();

        showDialog("Er du sikker på at du vil fjerne denne brukeren?", {
            ja : function(){
                $.ajax({
                    url : "",
                    method : 'post',
                    data : {
                        '_method' : 'delete',
                        '_token'  : '@csrf()',
                        'user_id' 	  : _this.data("id")
                    },
                    success : function(){
                        thisUser.slideUp();
                    },
                    error : function(){
                        showDialog('Vi klarte ikke å fjerne brukeren. prøv igjen senere', {ok : ''})
                    }
                });//ajax
            },
            nei : function(){
                
            }
        });//dialog
    });//event decline

</script>
@layout('layout.foot')