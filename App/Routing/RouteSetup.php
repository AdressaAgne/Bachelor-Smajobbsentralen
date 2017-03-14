<?php

/**
*   Direct Setup
*   Direct::[get, post, put, patch, delete](url, controller@method)->[auth(callback), admin]
*/

Direct::get("/", 'MainController@index');
Direct::get("/migrate", 'MainController@migrate');


Direct::get('/admin', 'AdminController@index');

Direct::get('/admin/settings', 'AdminController@settings');
Direct::patch('/admin/settings', 'AdminController@patch_settings');

Direct::get('/admin/themes', 'AdminController@themes');
Direct::patch('/admin/themes', 'AdminController@patch_themes');

Direct::get('/admin/pages', 'AdminController@pages');
Direct::get('/page/arrange/{page}', 'AdminController@arrange_blogposts');
Direct::patch('/page/arrange', 'AdminController@arrange_blogposts_patch');

Direct::get('/admin/posts', 'AdminController@posts');
Direct::put('/post/create', 'AdminController@put_posts');

Direct::get('/admin/media', 'AdminController@media');
Direct::put('/admin/media', 'AdminController@put_media');

Direct::get('/list', 'AdminController@route');

Direct::stack('/page', 'PageController');

