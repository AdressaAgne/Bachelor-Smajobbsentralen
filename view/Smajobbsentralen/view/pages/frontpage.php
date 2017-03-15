<article>
    <h3>{{ $page->header }}</h3>
    <p>@format($page->content)</p>

    <ul>
    @foreach($class->categories() as $cat)
    
        <li>{{$cat}}</li>
    
    @endforeach
    </ul>
</article>