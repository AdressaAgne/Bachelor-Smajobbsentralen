@panel('layout.head', ['title' => 'Pages'])
    <h1>Pages</h1>
    
    <div class="row">
        <h3>New Page</h3>
        @form($source.'/page/create', 'put')
            <div class="admin-panel">
                <div class="form-element col-6 col-m-12">
                    <label>Header
                        <input type="text" placeholder="Header" name="header">
                    </label>
                </div>
                <div class="form-element col-6 col-m-12">
                    <label>Permalink
                        <input type="text" placeholder="Url" name="permalink">
                    </label>
                </div>
                <div class="form-element col-6 col-m-12">
                    <label for="dropdown">Select page style</label>
                    <select name="style" id="dropdown" class="dropdown">
                        @foreach($pagetypes as $style)
                            <option value="{{$style}}">{{$style}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-element col-6 col-m-12">
                    <label for="types">Type</label>
                    <select name="type" id="types" class="dropdown">
                            <option value="page">Page</option>
                            <option value="post">Post</option>
                            <option value="blog">Blog</option>
                    </select>
                </div> 
                <div class="form-element col-12">
                    <textarea name="content" id="" cols="30" rows="10" class="form-control" placeholder="Content"></textarea>
                </div>
                <div class="form-element col-12">
                    <label for="">
                        <input id="visible" class="checkbox" type="checkbox" name="visible">
                        <label for="visible" class="checkbox">Visible in Menu</label>
                    </label>
                </div>
                <div class="form-element col-12">
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
@panel('layout.foot')