@layout('layout.head', ['title' => 'Småjobbsentralen'])
    
    <!-- check if the selected page has a controller with it -->
    <div class="hero" style="background-image: url('{{$assets}}/img/home.jpg')">    
        <div class="container hero--header">
            <div class="brick hidden-s">
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
            
            <div class="row visible-s">
                <div class="col-12">
                    <div class="brick">
                        <p class="font-medium"><strong><i class="fa fa-phone"></i> <a href="tel:{{$global->get_priser()['tlf']['value']}}">{{$global->get_priser()['tlf']['value']}}</a></strong></p>
                        <p>{{$open['isOpen']}} nå</p>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Småjobbsentralen i Gjøvik</h1>

                <p>Formidler lønnet hjelp til mindre oppdrag (inntil 3 timer).</p>
                <p>Oppdrag utover det avtales spesielt.</p>
                
                <h3>Henvendelse:</h3>
                @foreach($open['timeStr'] as $str)
                    <p>{{ $str }}</p>
                @endforeach
                <p>tlf. 61 10 95 80 </p>
                <address>Øvre Torvgate 2, 2815 Gjøvik (Furubakken)</address>

                <h3>Hva slags arbeidsoppgaver formidles?</h3>

                <p>Småreparasjoner, husarbeid, mindre malejobber, hagearbeid m.m.</p>

                <h3>Hva er småjobbsentralen, og hvem kan få hjelp der?</h3>

                <p>Småjobbsentralen ledes av et styre, bestående av valgte representanter fra organisasjoner som dekker bredes mulig interesseområde både blant yngre og eldre, politisk aktive personer og andre uorganiserte. FHS kan være representert med ett styremedlem. Småjobbsentralen formidler arbeidsoppdrag til eldre og uføre.</p>

                <h3>Hvem kan ta på seg arbeidsoppdrag?</h3>

                <p>Alle over 16 år kan melde seg til arbeidsoppdrag. Det er en forutsetning at du er skikket for oppdraget. Nærmere regler for dette får du på småjobbsentralen.  </p>

                <h3>Hva slags arbeidsoppdrag kan formidles gjennom sentralen? </h3>
                Småreperasjoner, husarbeid, mindre malerarbeid, hagearbeid, vedarbeid, snørydding. Hvilke oppgaver som kan løses, avhenger av hva slags oppdrag de registrerte kan påta seg.

                <h3>Hva koster det å få hjelp på småjobbsentralen?</h3>

                <p>Betaling for utført oppdrag skjer direkte mellom den som har bestilt oppdraget, og den som utfører oppdraget.</p>

                <h3>Satsene er slik:</h3>
                <?php $priser = $global->get_priser() ?>
                <ul>
                    <li>Utføring av arbeidsoppdrag kr {{$priser['hours']['value']}},-/time (påbegynt time avrundes oppover til nærmeste halvtime). </li>
                    <li>Bruk av egen bil betales med kr {{$priser['km']['value']}}/km, med tilhenger kr {{$priser['km_hitch']['value']}},-/km </li>
                    <li>Bruk av egen tilhenger, gressklipper, snøfreser, elektrisk hekksaks og lignende, betales med kr {{$priser['equipment']['value']}},-/time</li>
                </ul>
                <h3>Hvordan kommer jeg i kontakt med Småjobbsentralen?</h3>

                <p>Ring tlf. {{$global->get_priser()['tlf']['value']}}, hver tirsdag eller torsdag i tidsrommet kl. 10.00-12.00 så får du snakket med noen på vakttelefonen, eller stikk innom oss i Øvre Torvgate nr 2. Her får du mer informasjon om tjenesten, og kan registrere deg enten som bruker av tjenesten, eller fordi du ønsker å påta deg oppdrag!</p>
            </div>
        </div>
    </div>
@layout('layout.foot')