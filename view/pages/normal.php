@layout('head', ['title' => $page->header])
   
    <a href="/page/{{$page->permalink}}/edit">edit</a>
    
    <article>
        <h1>{{ $page->header }}</h1>
        <p>{{ $page->content }}</p>
    </article>
@layout('foot')