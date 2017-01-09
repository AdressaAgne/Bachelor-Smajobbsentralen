<?php

/**
*   Direct Setup
*   Direct::[get, post, put, patch, delete](url, controller@method)->[auth(callback), admin]
*/

Direct::get("/", 'MainController@index');
Direct::get("/migrate", 'MainController@migrate');


Direct::get('/admin', 'AdminController@index');
Direct::get('/admin/settings', 'AdminController@settings');
Direct::get('/admin/themes', 'AdminController@themes');

Direct::get('/list', 'AdminController@route');

Direct::stack('/page', 'PageController');

