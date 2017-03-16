<article>
    <h3>{{ $page->header }}</h3>
    <p>@format($page->content)</p>

    <ul>
    @foreach($class->categories() as $cat)
    
        <li><i class="fa fa-{{$cat['icon']}}"></i>{{$cat['name']}}</li>
    
    @endforeach
    </ul>
</article>