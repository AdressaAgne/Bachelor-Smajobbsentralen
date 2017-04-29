<div class="col-8">
       <article class="card">

    <div class="header-image" style="background-image: url({{$post->image()->small}});">
        <div class="header-text">
            <h3>{{ $post->header }}</h3>
        </div>
    </div>



    <div class="description">
        <p>@sub($post->content, 2)</p>
        <p><a href="/page/{{$post->permalink}}">Vis {{ $post->header }}</a></p>
    </div>

    </article>
</div>