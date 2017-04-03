<div class="row">
	@if(!empty($page->header))
		<h3>{{$page->header}}</h3>
	@endif
</div>
@layout('layout.telefonvakt_menu')
<div class="row">
    <div class="col-12">
        <h1>Åpningstider</h1>
        @form('', 'POST')
            @for($i = 0; $i < 7; $i++)
            <div class="col-6">
                <div class="form-element">
                    <input class="checkbox" type="checkbox" id="{{$global->ISO_8601($i)}}" name="{{$global->ISO_8601($i)}}">
                    <label class="checkbox" for="{{$global->ISO_8601($i)}}">{{$global->ISO_8601($i)}}</label>
                </div>
            </div>
            @endfor
        @formend()
    </div>
</div>
