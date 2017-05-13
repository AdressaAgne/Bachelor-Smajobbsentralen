@layout('layout.head', ['title' => 'Småjobbsentralen'])
    
    <!-- check if the selected page has a controller with it -->
    
    </div>
    <div class="hero" style="background-image: url('{{$assets}}/img/home.jpg')">    
        <div class="container hero--header">
            <div class="brick">
                <div class="row">
                    <?php $open = $global->opentimes(); ?>
                    <div class="col-12 border-bottom">
                        <p>Vi formidler rimelig hjelp til eldre og uføre</p>
                    </div>
                    <div class="col-6 col-m-12 border-right">
                        <p>{{$open['isOpen']}} nå</p>
                        <p class="font-big"><strong><i class="fa fa-phone"></i> {{$global->get_priser()['tlf']['value']}}</strong></p>
                    </div>
                    <div class="col-6 col-m-12">
                        <small class="font-small">Åpningstider: </small>
                        @foreach($open['timeStr'] as $str)
                            <p class="font-small">{{ $str }}</p>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <article>
            <div class="row">
                <h1>Hva kan vi hjelpe deg med?</h1>
                @foreach($cats as $cat)
                <div class="col-4 col-m-6">
                    <a href="/smajobbere/{{$cat['id']}}">
                        <div class="col-12 brick brick--big">
                            <div>{{ucfirst($cat['name'])}}</div>
                            <i class="fa fa-{{$cat['icon']}}"></i> 
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </article>
    </div>
    
@layout('layout.foot')