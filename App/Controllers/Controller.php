<?php

namespace App\Controllers;
use DB, Account, User;

class Controller extends DB{
    
    public static $site_wide_vars = [
        'user' => null,
        'google_key' => 'AIzaSyC7i0o5mdEYSbG_wqoWAx53tAP1xxTKVQo',
        'menu' => [],
    ];
    
    /**
     * This code runs with all controllers
     * @private
     * @author Agne *degaard
     */
    public function __construct(){
        parent::__construct();
        
        if(Account::isLoggedIn()){
            self::$site_wide_vars['user'] = new User($_SESSION['uuid']);
        }
        
        self::$site_wide_vars['menu'] = $this->select('pages', ['visible' => '1']);
        
    }
}