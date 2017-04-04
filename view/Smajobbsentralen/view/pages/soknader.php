<div class="row">
	@if(!empty($page->header))
		<h1>{{$page->header}}</h1>
	@endif
	@if(!empty($page->content))
		<h3>{{$page->content}}</h3>
	@endif
</div>
@layout('layout.telefonvakt_menu')
<div class="row">
    <div class="col-12">
        <div class="row" id="loading" style="display:none;">
          <label for="file" class="col--center" style="width: 150px;">
              <svg height="150" width="150" class="pie-chart processing" id="svg">
                <circle class="behind"cx="50%" cy="50%" r="40%" />
                <circle class="front" cx="50%" cy="50%" r="40%" data-percent="0" />
              </svg>
          </label>
        </div>

        <div id="smajobbere">
            @foreach($class->get_soknader() as $smajobber)
                <div class="row smajobbere-list">
                    <div class="col-12">
                        <h1>{{$smajobber['name']}} {{$smajobber['surname']}}</h1>
                        <h1><strong><i class="fa fa-phone"></i> {{$class->format_phonenr($smajobber['mobile_phone'])}}</strong></h1>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@layout('layout.scripts')

<script>

    function formatPhoneNr(nr){
        return nr.replace(/(\d{3})(\d{2})(\d{3})/, '$1 $2 $3');
    }
</script>
