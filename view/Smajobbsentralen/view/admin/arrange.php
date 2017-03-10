@layout('layout.head', ['title' => 'Edit Page'])
   
    <h3>Arrange posts on {{ $page->header }}</h3>
    
    <div class="container">
    @foreach($page->children() as $key => $post)
        <div class="row">
            <div class="col-12">
                @form('page/arrange/', 'patch')
                <input type="hidden" name="key" value="{{$key}}">
                <div class="col-3">
                    <button>Top</button>
                </div>
               <div class="col-3">
                     <button>Up</button>
                </div>
                <div class="col-3">
                    <button>Down</button>
                </div>
                <div class="col-3">
                    <button>Bottom</button>
                </div>
                @formend()
            </div>
            @layout('posts.'.$post->style, ['post' => $post])
        </div>
    @endforeach
    </div>
    
@layout('layout.foot')