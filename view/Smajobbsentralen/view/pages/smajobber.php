<div class="row">
    @if(!empty($page->header))
        <h3>{{$page->header}}</h3>
    @endif
    @if(!empty($page->content))
        <h1>{{$page->content}}</h1>
    @endif
</div>

<div class="row">
    <div class="col-2">
        @foreach($class->get_cats() as $cat)
        
            <button class="col-12">{{$cat['name']}}</button>
        
        @endforeach
    </div>
    
    <div class="col-10">
    @foreach($page->children() as $post)

            @layout('posts.'.$post->style, ['post' => $post])

    @endforeach
    </div>
</div>
