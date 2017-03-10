@layout('layout.head', ['title' => 'Pages'])
    @layout('layout.admin_menu')
    <h1>Pages</h1>
    
    <div class="row">
        <h3>New Page</h3>
        @form('page/create', 'put')
            <div class="admin-panel">
                <div class="form-element">
                    <input type="text" placeholder="Header" name="header">
                </div>
                <div class="form-element">
                    <input type="text" placeholder="Url" name="permalink">
                </div>
                <div class="form-element">
                    <h4>Select page style</h4>
                    <select name="style" id="">
                        @foreach($pagetypes as $style)
                            <option value="{{$style}}">{{$style}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-element">
                    <textarea name="content" id="" cols="30" rows="10" class="form-control" placeholder="Content"></textarea>
                </div>
                <div class="form-element">
                    <label for="">
                        Visible in menu: <input type="checkbox" checked name="visible">
                    </label>
                </div>
                <div class="form-element">
                    <input type="submit" value="Create new page">
                </div>
            </div>
        @formend()
    </div>
    
    <div class="row">
       <h3>Overview</h3>
        <table>
            <thead>
                <tr>
                    <td>Header</td>
                    <td>Link</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
            @foreach($pages as $page)
                <tr>
                    <td>{{$page->header}}</td>
                    <td>/page/{{$page->permalink}}</td>
                    <td><a href="/page/{{$page->permalink}}" class="btn">View</a></td>
                    <td><a href="/page/edit/{{$page->permalink}}" class="btn">Edit</a></td>
                    <td>
                        @if($page->style == 'blog')
                            <a href="/page/arrange/{{$page->permalink}}" class="btn">Arrange</a>
                        @endif        
                    </td>
                    <td>
                        @form('/page/', 'delete')
                            <input type="hidden" value="{{$page->id}}" name="id">
                            <input type="submit" value="Delete">
                        @formend()
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@layout('layout.foot')