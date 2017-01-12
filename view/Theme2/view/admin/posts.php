@layout('layout.head', ['title' => 'Edit Page'])
    @layout('layout.admin_menu')
    <div class="row">
        <h3>New Post</h3>
        @form('/post/create', 'put')
            <div class="admin-panel">
              <div class="form-element">
                  <input type="text" placeholder="header" name="header">
              </div>
              <div class="form-element">
                    <h4>Select a blog</h4>
                    <select name="parent" id="">
                        @foreach($blogs as $blog)
                            <option value="{{$blog->id}}">{{$blog->header}}</option>
                        @endforeach
                    </select>
              </div>
              <div class="form-element">
                    <h4>Select a blog style</h4>
                    <select name="style" id="">
                        @foreach($pagetypes as $style)
                            <option value="{{$style}}">{{$style}}</option>
                        @endforeach
                    </select>
              </div>
              <div class="form-element">
                  <textarea name="content" id="" cols="30" rows="10" class="form-control" placeholder="content"></textarea>
              </div>
              <div class="form-element">
                  <input type="submit" value="Create new post">
              </div>
            </div>
        @formend()
    </div>
@layout('layout.foot')