    </div>
</div>

<article class="hero-card"  style="background-image: url({{$post->image()->small}});">
    <div class="container">
        <a href="/page/{{$post->permalink}}"><h3>{{ $post->header }}</h3></a>

        <div class="description">
            <p>@sub($post->content, 2)</p>
        </div>
    </div>
</article>


<div class="container">
    <div class="row">