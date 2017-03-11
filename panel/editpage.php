@panel('layout.head', ['title' => 'Edit Page'])
    <h1>Edit {{ $page->header }}</h1>
    @form('', 'patch')
        <h4>Edit Page</h4>
        <div class="col-12">
            <input type="text" placeholder="header" name="header" value="{{ $page->header }}">
        </div>
        <div class="col-12">
            <input type="text" placeholder="/page/..." name="permalink" value="{{ $page->permalink }}">
        </div>
        <div class="col-12">
            <textarea name="content" id="" cols="30" rows="10">{{ $page->content }}</textarea>
        </div>
        <div class="col-12">
            <label for="">
                Visible in menu: <input type="checkbox" @checked($page->visible) name="visible">
            </label>
        </div>
        <div class="col-12">
            <input type="hidden" value="{{$page->id}}" name="id">
            <input type="submit" value="edit page">
        </div>
    @formend()
@panel('layout.foot')