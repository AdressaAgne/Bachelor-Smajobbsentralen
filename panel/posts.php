@panel('layout.head', ['title' => 'Posts'])
    <h1>Posts</h1>
     <div class="row">
        <h3>New Post</h3>
        @form('/post/create', 'put')
            <div class="admin-panel">
              <div class="row">
                  <div class="col-6">
                        <div class="form-element">
                            <h4>Post header</h4>
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
                            <h4>Select a post style</h4>
                            <select name="style" id="">
                                @foreach($pagetypes as $style)
                                    <option value="{{$style}}">{{$style}}</option>
                                @endforeach
                            </select>
                        </div>
                  </div>
                  <div class="col-6">
                      
                      <div class="form-element">
                          <h4>Select an image</h4>
                          @layout('admin.layout.image', ['media' => $media])
                      </div>
                  </div>
              </div>
              <div class="row">
                 <div class="col-12">
                      <div class="form-element">
                          <textarea name="content" id="" cols="30" rows="10" class="form-control" placeholder="content"></textarea>
                      </div>
                      <div class="form-element">
                          <input type="submit" value="Create new post">
                      </div>
                  </div>
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
                </tr>
            </thead>
            <tbody>
            @foreach($posts as $post)
                <tr>
                    <td>{{$post->header}}</td>
                    <td>/page/{{$post->permalink}}</td>
                    <td><a href="/page/{{$post->permalink}}" class="btn">View</a></td>
                    <td><a href="/page/edit/{{$post->permalink}}" class="btn">Edit</a></td>
                    <td>
                        @form('/page/', 'delete')
                            <input type="hidden" value="{{$post->id}}" name="id">
                            <input type="submit" value="Delete">
                        @formend()
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
   
@panel('layout.foot')