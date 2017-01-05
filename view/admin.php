@layout('head', ['title' => 'Welcome'])
    <h1>Admin</h1>
    
    @form('', 'put')
       
        <h4>New Page</h4>
        <div class="col-12">
            <input type="text" placeholder="header" name="header">
        </div>
        <div class="col-12">
            <input type="text" placeholder="/page/..." name="permalink">
        </div>
        <div class="col-12">
            <textarea name="content" id="" cols="30" rows="10"></textarea>
        </div>
        <div class="col-12">
            <label for="">
                Visible in menu: <input type="checkbox" checked name="visible">
            </label>
        </div>
        <div class="col-12">
            <input type="submit" value="create new page">
        </div>
    
    @formend()
    
@layout('foot')