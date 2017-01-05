@layout('layout.head', ['title' => 'Welcome'])
    <h1>Admin <small>Dashboard</small></h1>
    <p>Welcome 'Administrator'</p>

    @form('page/create', 'put')
        <div class="col-6 admin-panel">

          <h4>New Page</h4>
          <div class="col-12 form-element">
              <input type="text" placeholder="header" name="header">
          </div>
          <div class="col-12 form-element">
              <input type="text" placeholder="/page/..." name="permalink">
          </div>
          <div class="col-12 form-element">
              <textarea name="content" id="" cols="30" rows="10" class="form-control" placeholder="content"></textarea>
          </div>
          <div class="col-12 form-element">
              <label for="">
                  Visible in menu: <input type="checkbox" checked name="visible">
              </label>
          </div>
          <div class="col-12">
              <input type="submit" value="create new page">
          </div>
        </div>
    @formend()

@layout('layout.foot')
