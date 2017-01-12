@layout('layout.head', ['title' => 'Settings'])
    @layout('layout.admin_menu')
    <h1>Settings</h1>
    
    <div class="row">
        <h3>Front page</h3>
        @form('','patch')
            @foreach($pages as $key => $page)
                <div class="col-4">
                    
                    @if($settings['frontpage'] == $page->id)
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
    </div>
    
    <div class="row">
        <h3>Meta data</h3>
            <table>
            <thead>
                <tr>
                    <td>Name</td>
                    <td>Value</td>
                </tr>
            </thead>
            <tbody>
                @foreach($settings as $key => $value)
                <tr>
                    <td>{{$key}}</td>
                    <td>{{$value}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        
    </div>
    
    
@layout('layout.foot')