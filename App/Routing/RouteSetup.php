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

// Mainpage
Direct::get("/", 'MainController@index');

// All Småjobbere
Direct::get('/smajobbere', 'SmajobberController@smajobbere');
Direct::post('/smajobbere', 'SmajobberController@post');

// Bli småjobber / send inn applications
Direct::get('/blismajobber', 'SmajobberController@application');
Direct::put('/blismajobber', 'SmajobberController@put');

// Admin - Redirect helper
Direct::get('/admin', 'AdminController');

// Admin - Telefonvakt
Direct::get('/telefonvakt/{month?}/{year?}', 'AdminController')->Auth();
Direct::put('/telefonvakt/{month?}/{year?}', 'AdminController@calendar_put')->Auth();

// Admin - Kunder
Direct::get('/kunder', 'MembersController')->Auth();
Direct::put('/kunder', 'MembersController@new_member')->Auth();

// Admin - Faktura
Direct::get('/faktura', 'MembersController')->Auth();
Direct::put('/faktura', 'MembersController@new_faktura')->Auth();
Direct::delete('/faktura', 'MembersController@delete_member')->Auth();

// Admin - Applications
Direct::get('/soknader', 'ApplicationController@index')->Auth();
Direct::patch('/soknader', 'ApplicationController@patch')->Auth();
Direct::delete('/soknader', 'ApplicationController@delete')->Auth();

// Admin - members


// Admin - opningstider
Direct::get('/opningstider', 'SettingsController')->Auth();
Direct::post('/opningstider', 'SettingsController')->Auth();

// Admin - arbeidstyper
Direct::get('/arbeidstyper', 'SettingsController')->Auth();
Direct::put('/arbeidstyper', 'SettingsController@put_arbeidstyper')->Auth();
Direct::delete('/arbeidstyper', 'SettingsController@delete_arbeidstype')->Auth();

if(Config::$debug_mode){
    Direct::get("/route", 'MainController');
    Direct::get("/migrate", 'MainController');
}

Direct::get("/login", 'LoginController@index');
Direct::post("/login", 'LoginController');
Direct::get("/logout", 'LoginController');

//Direct::get('/list', 'AdminController@route')->admin();



// Errors
Direct::err('403', 'ErrorController@noaccess');
Direct::err('404', 'MainController@index');
