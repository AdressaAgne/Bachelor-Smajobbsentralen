</div>

<div class="container--fluid" style="background-color: red;">
    <h1>Smajobbsentralen</h1>
</div>

<div class="container">
    <article>

        <p>@format($page->content)</p>

        <div class="row">
            <h1>Hva kan vi hjelpe deg med?</h1>
            @foreach($class->categories() as $cat)
            <div class="col-4">
                <div class="col-12 brick">
                    <div>{{ucfirst($cat['name'])}}</div>
                    <i class="fa fa-{{$cat['icon']}}"></i> 
                </div>
            </div>
            @endforeach
        </div>
    </article>