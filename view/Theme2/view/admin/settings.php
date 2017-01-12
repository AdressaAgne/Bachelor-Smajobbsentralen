@layout('layout.head', ['title' => 'Edit Page'])
    @layout('layout.admin_menu')
    <h1>Settings</h1>
    
    @form('','patch')
        <h3>Front page</h3>
        
        
        @foreach($pages as $key => $page)
            <div class="col-4">
                
                @if($settings == $page->id)
                    <input type="radio" class="page-select" name="frontpage" id="frontpage-{{$key}}" checked value="{{$page->id}}">
                @else
                    <input type="radio" class="page-select" name="frontpage" id="frontpage-{{$key}}" value="{{$page->id}}">
                @endif    
                <label for="frontpage-{{$key}}" class="page-select">
                    <small>/page/{{$page->permalink}}</small>
                    <h2>{{$page->header}}</h2>
                    <p>{{$page->content}}</p>
                </label>
            </div>
            
        @endforeach
        <div class="form-element">
            <input type="submit" value="Save Changes">
        </div>
    @formend()
    
    
@layout('layout.foot')