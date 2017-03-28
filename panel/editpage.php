@panel('layout.head', ['title' => 'Edit Page'])
    <h1>Edit: {{ $page->header }}</h1>
    @form('', 'patch')
        <h4>Edit Page</h4>
        <div class="col-6 col-m-12">
            <div class="form-element col-12">
                <label>Header
                    <input type="text" placeholder="header" name="header" value="{{ $page->header }}">
                </label>
            </div>        
        </div>
        
        <div class="col-6 col-m-12">
            <div class="form-element col-12">
                <label>Permalink
                    <input type="text" placeholder="/page/..." name="permalink" value="{{ $page->permalink }}">
                </label>
            </div>
        </div>
        
        <div class="col-6 col-m-12">
            <div class="form-element col-12">
                <h4>Parent</h4>
                <select name="parent" id="parent" class="dropdown">
                    <option value="">None</option>
                    @foreach($parents as $p)
                        @if($page->parent == $p->id)
                            <option value="{{$p->id}}" selected="">{{$p->header}}</option>
                        @else
                            <option value="{{$p->id}}">{{$p->header}}</option>
                        @endif
                    @endforeach
                </select>
                <label for="parent" class="dropdown"></label>
            </div>
            
            <div class="form-element col-12">
                <h4>Template</h4>
                <select name="style" id="styles" class="dropdown">
                    <option value="">none</option>
                    @foreach($types as $style)
                        @if($page->style == $style)
                            <option value="{{$style}}" selected>{{$style}}</option>
                        @else
                            <option value="{{$style}}">{{$style}}</option>
                        @endif
                    @endforeach
                </select>
                <label for="styles" class="dropdown"></label>
            </div>   
             
            <div class="form-element col-12">
                <h4>Type:</h4>
                <select name="type" id="types" class="dropdown">
                        <option value="page" @selected($page->type == 'page')>Page</option>
                        <option value="post" @selected($page->type == 'post')>Post</option>
                        <option value="blog" @selected($page->type == 'blog')>Blog</option>
                </select>
                <label for="types" class="dropdown"></label>
            </div>    
        </div>
        
        <div class="col-6 col-m-12">
            <div class="form-element col-12">
                <h4>Select an image</h4>
                @panel('layout.image', ['media' => $media, 'selected' => $page])
            </div>
        </div>
        
        <div class="col-12">
            <input id="visible" class="checkbox" type="checkbox" @checked($page->visible) name="visible">
            <label for="visible" class="checkbox">Visible in Menu</label>
        </div>
        
        <div class="col-12">
            <div class="form-element col-12">
                <label>Content
                    <textarea name="content" id="" cols="30" rows="10">{{ $page->content }}</textarea>
                </label>
            </div>
        </div>
        
        <div class="col-12">
            <input type="hidden" value="{{$page->id}}" name="id">
            <input type="submit" value="edit page">
        </div>
    @formend()
@panel('layout.foot')