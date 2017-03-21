<?php

namespace App\Controllers;
use DB, Account, User, Config, Direct, View;

class Controller extends DB{
    
    public static $site_wide_vars = [
        'user' => null,
        'google_key' => 'AIzaSyC7i0o5mdEYSbG_wqoWAx53tAP1xxTKVQo',
        'menu' => null,
        'assets' => null,
        'settings' => null,
    ];
    
    /**
     * This code runs with all controllers
     * @private
     * @author Agne *degaard
     */
    public function __construct(){
        parent::__construct();

        if(!@$this->query('SELECT * FROM Settings')){
            if(Config::$route != '/migrate'){
                die('Database need to migrate, go to /migrate');
            }         
        } else {
            
            self::$site_wide_vars['settings'] = $this->cms();
            Config::$theme = self::$site_wide_vars['settings']['theme'];
            
            self::$site_wide_vars['assets'] = '/view/'.Config::$theme.'/assets';
            
            if(Account::isLoggedIn()){
                self::$site_wide_vars['user'] = new User($_SESSION['uuid']);
            }
            
            self::$site_wide_vars['menu'] = $this->select('pages', ['*'], ['visible' => '1', 'auth' => '0'])->fetchAll();
        }
    }
    
    public function callThemeController($page){
        
        //check if a designated controller for the view file exists, if so call it and pass it to the file.
        $theme = '/view/'.Config::$theme;
        $controller = '.'.$theme.'/Controllers/'.$page->style.'.php';
        
        if(file_exists($controller)){
            include_once($controller);
            $class = new $page->style($this, $page);
            
            if(isset($_POST['_method']) && method_exists($class, strtolower($_POST['_method']))){
                return call_user_func([$class, strtolower($_POST['_method'])], array_merge($_POST, $_GET));
            }
            
            return [true, View::make('index', ['page' => $page, 'class' => $class])];
        }
        return [false];
    }
    
    public function __call($method, $params){
        die($params[0]['param'] . ": Could not find method <b>$method</b> in <em>".static::class."</em>");
    }
    
    public function cms(){
        $settings = $this->all('settings');

        foreach($settings as $key => $value){
            $settings[$value['name']] = $value['value'];
            unset($settings[$key]);
        }

        return $settings;
    }
    
}