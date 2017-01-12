@layout('layout.head', ['title' => 'Edit Page'])
    @layout('layout.admin_menu')
    <h1>Themes</h1>
    
    @form('/admin/themes', 'patch')
        @foreach($themes as $key => $theme)
            <div class="col-4 theme">
                @if($settings == $theme)
                    <input type="radio" class="page-select" name="theme" id="theme-{{$key}}" checked value="{{$theme}}">
                @else
                    <input type="radio" class="page-select" name="theme" id="theme-{{$key}}" value="{{$theme}}">
                @endif    
                <label for="theme-{{$key}}" class="page-select">
                    <h2>{{$theme}}</h2>
                    <img src="/view/{{$theme}}/screenshot.png" alt="">
                </label>
            </div>
        @endforeach
        <div class="form-element">
            <input type="submit" value="Save Changes">
        </div>
    @formend()
    
@layout('layout.foot')