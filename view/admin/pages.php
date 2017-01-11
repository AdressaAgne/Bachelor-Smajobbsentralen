@layout('layout.head', ['title' => 'Edit Page'])
    @layout('layout.admin_menu')
    <h1>Settings</h1>
    
    
    
    <table>
    
        <thead>
            <tr>
                <td>Header</td>
                <td>Link</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
        @foreach($pages as $page)

            <tr>
                <td>{{$page->header}}</td>
                <td>/page/{{$page->permalink}}</td>
                <td><a href="/page/edit/{{$page->permalink}}" class="btn">Edit</a></td>
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
    
@layout('layout.foot')