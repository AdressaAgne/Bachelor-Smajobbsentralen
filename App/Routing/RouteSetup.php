<?php

/**
*   Direct Setup
*   Direct::[get, post, put, patch, delete](url, [controller@method, controller, callable])->[auth(), admin(), mod()]
*   url = /test/{var}/{optional?}
*   add a ? at the end of a variable to make it optional like {var?}
*
*   if you do not set a method, it will try to call the route as a method instead
*   Direct::get("/home", 'MainController');
*   this will try to call the home method in the MainController
*/

Direct::get('/test/{x}/{y}/{z?}', function(Request $data){
    // $get = $data->get;
    // $post = $data->post;
    // $method = $data->method();
    // $url = $data->url();
    // $get_url = $data->get_url();
    return [$_SERVER];
});

Direct::get("/", 'MainController@index');

if(Config::$debug_mode){
    Direct::get("/route", 'MainController');
    Direct::get("/migrate", 'MainController');
}

Direct::get("/login", 'LoginController@index');
Direct::post("/login", 'LoginController');
Direct::get("/logout", 'LoginController');

Direct::get('/admin', 'AdminController@index')->admin();

Direct::get('/admin/settings', 'AdminController@settings')->admin();
Direct::patch('/admin/settings', 'AdminController@patch_settings')->admin();

Direct::get('/admin/themes', 'AdminController@themes')->admin();
Direct::patch('/admin/themes', 'AdminController@patch_themes')->admin();

Direct::get('/admin/pages', 'AdminController@pages')->admin();
Direct::get('/page/arrange/{page}', 'AdminController@arrange_blogposts')->admin();
Direct::patch('/page/arrange', 'AdminController@arrange_blogposts_patch')->admin();

Direct::get('/admin/posts', 'AdminController@posts')->admin();
Direct::put('/post/create', 'AdminController@put_posts')->admin();

Direct::get('/admin/media', 'AdminController@media')->admin();
Direct::put('/admin/media', 'AdminController@put_media')->admin();

Direct::get('/list', 'AdminController@route')->admin();

Direct::put('/page/{id}', 'PageController@item');
Direct::post('/page/{id}', 'PageController@item');
Direct::patch('/page/{id}', 'PageController@item');
Direct::delete('/page/{id}', 'PageController@item');

Direct::stack('/page', 'PageController');


// Errors
Direct::err('403', 'ErrorController@noaccess');
Direct::err('404', 'MainController@index');
