

<div class="row">
    @if(!empty($page->header))
        <h3>{{$page->header}}</h3>
    @endif
    @if(!empty($page->content))
        <h1 class="qoute">{{$page->content}}</h1>
    @endif
</div>

<div class="row">
@foreach($class->get_applications() as $user)
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
                <li>Adresse: not in db....</li>
                <li>Født: {{$user->dob}}</li>
                <li>Alder: {{$class->get_age($user->dob)}}</li>
                <li>Okkupasjon: {{$user->occupation}}</li>
            </ul>
        </p>
        <p>
            <strong>Kan jobbe med: </strong> {{ implode(', ', $class->get_work($user->id)) }}
        </p>
        <p>
            <strong>annen info:</strong>
            {{$user->other_info}}
        </p>
        @form('', 'post')
            <input type="hidden" name="user_id" value="{{$user->id}}">
            <input type="submit" value="Aksepter">
        @formend()
        </div>
    </div>
@endforeach
</div>