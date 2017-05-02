<?php

/**
*   Direct Setup
*   Direct::[get, post, put, patch, delete, debug](url, [controller@method, controller, callable])->[Auth(), Admin(), Mod(), Cache()]
*   Example:
*   Direct::get('/', 'MainController@index')
*   Direct::get('/profole', 'MainController@profole')->auth()
* 
*   url = /test/{var}/{optional?}
*   add a ? at the end of a variable to make it optional like {var?}
*
*   if you do not set a method, it will try to call the route as a method instead
*   Direct::get("/home", 'MainController');
*   this will try to call the home method in the MainController
*
*   Aditional you can do:
*   for GET, POST, PATCH, PUT, DELETE at the same time (does not include ERROR)
*   Direct::all(url, callable);
*   Or if you want more then one method but not all
*   Direct::on([GET, POST, PATCH, PUT, DELETE, ERROR], url, callable);
*/

Direct::get('/test', function(){
    return '<h1>This is supposed to be cached lol</h1>';
})->Cache();


// Mainpage
Direct::get("/", 'MainController@index');

Direct::get("/om", 'MainController@om');

// All Småjobbere
Direct::get('/smajobbere', 'SmajobberController');
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
Direct::get('/oppdragstaker/kunder', 'MembersController@kunder')->Auth();
Direct::put('/oppdragstaker/kunder', 'MembersController@new_member')->Auth();

// Admin - Faktura
Direct::get('/oppdragstaker/faktura', 'MembersController@faktura')->Auth();
Direct::put('/oppdragstaker/faktura', 'MembersController@new_faktura')->Auth();
Direct::delete('/oppdragstaker/faktura', 'MembersController@delete_member')->Auth();

// Admin - Applications
Direct::get('/telefonvakt/soknader', 'ApplicationController@index')->Auth();
Direct::patch('/telefonvakt/soknader', 'ApplicationController@patch')->Auth();
Direct::delete('/telefonvakt/soknader', 'ApplicationController@delete')->Auth();

// Admin - members
Direct::get('/telefonvakt/smajobbere', 'SmajobberController@admin');

// Admin - opningstider
Direct::get('/telefonvakt/opningstider', 'SettingsController@opningstider')->Auth();
Direct::patch('/telefonvakt/opningstider', 'SettingsController@edit')->Auth();

// Admin - arbeidstyper
Direct::get('/telefonvakt/arbeidstyper', 'SettingsController@arbeidstyper')->Auth();
Direct::put('/telefonvakt/arbeidstyper', 'SettingsController@put_arbeidstyper')->Auth();
Direct::delete('/telefonvakt/arbeidstyper', 'SettingsController@delete_arbeidstype')->Auth();


Direct::get("/login", 'LoginController@index');
Direct::post("/login", 'LoginController');
Direct::get("/logout", 'LoginController');

// Errors
Direct::error('301', 'ErrorController@noaccess');
Direct::error('404', function(Request $request){
    return '404 page does not exist';
});

Direct::error('401', function(Request $request){
    return '401 premission denaid';
});

// Debug routes

Direct::debug("/route", 'MainController');
Direct::debug("/migrate", 'MainController');