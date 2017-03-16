<?php

namespace App;


class Config {


    public static $debug_mode = true;


    /**
    *   Database Connection
    */

    public static $host = 'localhost';
    public static $database = 'smajobb';
    public static $username = 'root';
    public static $password = 'root';

    public static $form_token = 'jlhkgfdlkshdjkskdfskjdhf';


    public static $cookie_time = 86400 * 30;
    public static $cache_time = 3600;
    public static $cache_folder = 'cache/';
    
    public static $route = '/';


    public static $files      = [
        "original"          => "/images/original/",
        "compressed"        => "/images/compressed/",
        "compressedSize"    => 600,
        "compressedSize2"   => 1000,
    ];

    public static $theme = 'basic';
    
    /**
    *   Namespace for controllers
    */

    public static $controllers = '\App\Controllers\\';


    /**
    *   Class aliases
    */

    public static $aliases = [

        // Config
        '\App\Config'                       => 'Config',


        // Database
        '\App\Database\Database'            => 'DB',
        '\App\Database\Row'                 => 'Row',
        '\App\Database\PID'                 => 'PID',
        '\App\Database\Timestamp'           => 'Timestamp',
        '\App\Database\Migrations'          => 'Migrations',
        '\App\Auth\Account'                 => 'Account',

        // Routing
        '\App\View'                         => 'View',
        '\App\Routing\Direct'               => 'Direct',
        '\App\Routing\Route'                => 'Route',
        '\App\Routing\RouteHandler'         => 'RouteHandler',
        '\App\Render'                       => 'Render',
        
        // Helpres

        '\App\Helpers\Uploader'             => 'Uploader',
        '\App\Helpers\Compressor'           => 'Compressor',
        '\App\Helpers\Sorting'              => 'Sorting',
        '\App\Controllers\Controller'       => 'BaseController',

        // Interfaces
        
        'App\Interfaces\ApiController'      => 'ApiController',
        'App\Interfaces\Module'             => 'Module',
        'App\Interfaces\StackController'    => 'StackController',
        'App\Interfaces\NormalController'   => 'NormalController',
        
        // Traits
        
        'App\Traits\IndexTrait'             => 'IndexTrait',
        'App\Traits\MigrateTrait'           => 'MigrateTrait',
        
        // Modules
        
        '\App\Modules\Page'                 => 'Page',
        '\App\Modules\User'                 => 'User',
        '\App\Modules\Image'                => 'Image',
        
    ];

}
