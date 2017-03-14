<div class="row">
    @if(!empty($page->header))
        <h3>{{$page->header}}</h3>
    @endif
    @if(!empty($page->content))
        <h1 class="qoute">{{$page->content}}</h1>
    @endif
</div>

<div class="row">
    @foreach($page->children() as $post)

            @layout('posts.'.$post->style, ['post' => $post])

    @endforeach
</div>
