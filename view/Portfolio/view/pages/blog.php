<div class="row">
    <h1>{{$page->header}}</h1>
    <p>{{$page->content}}</p>
</div>

@foreach($page->children() as $post)

    <div class="row">
        
        @layout('posts.'.$post->style, ['post' => $post])
        
    </div>

@endforeach
