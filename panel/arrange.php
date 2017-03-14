@panel('layout.head', ['title' => 'Edit Page'])
    <h3>Arrange posts on {{ $page->header }}</h3>
    
    <div class="container">
    @form('/page/arrange/', 'patch')
        <div id="post-container">
        @foreach($page->children() as $key => $post)
            <div class="arrange-post row" clickable>
                
                <div class="col-10">
                    <img src="{{$post->image()->small}}" alt="" width="50px">
                    <h3>{{$post->header}}</h3>
                </div>
                <div class="col-2">{{$post->style}}</div>
                <input type="hidden" name="posts[]" value="{{$post->id}}">
            </div>
        @endforeach
        </div>
        <div class="col-12 post">
            <input type="hidden" name="page" value="{{$page->permalink}}">
            <input type="submit" name="" value="Save">
        </div>
    @formend()
    </div>
    <script>
        var container = document.querySelector('#post-container');
        var up = document.querySelectorAll('[clickable]');
        for (var i = 0; i < up.length; i++) {
            up[i].addEventListener('click', function(e) {
                e.stopPropagation();
                this.moveUp();
            });
        }
        
        
        Element.prototype.moveUp = function () {
            this.parentNode.insertBefore(this, this.previousElementSibling);
        }
        Element.prototype.moveDown = function () {
            this.parentNode.insertBefore(this.nextElementSibling, this);
        }
        
    </script>
@panel('layout.foot')