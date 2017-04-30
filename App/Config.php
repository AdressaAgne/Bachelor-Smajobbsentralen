<?php

namespace App;


class Config {


    /**
    *   when true: No cache, adding /migrate and /route, missing controller checks
    */
    public static $debug_mode = true;


    /**
    *   Database Connection
    */

    public static $host = 'localhost';
    public static $database = 'smajobb';
    public static $username = 'root';
    public static $password = 'root';

    public static $form_token = 'jlhkgfdlkshdjkskdfskjdhf';
    
    /**
    *   Chache
    */
    
    public static $cookie_time = 86400 * 30;
    public static $cache_time = 3600;
    public static $cache_folder = 'cache/';
    
    /**
    *   Do not change
    */
   
    public static $route = '/';
    public static $source = '';

    /**
    *   File Uploading
    */
   
    public static $files      = [
        "original"          => "/public/images/original/",
        "compressed"        => "/public/images/compressed/",
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
        '\App\Config'                           => 'Config',

        // Database
        '\App\Container\Database\Database'      => 'DB',
        '\App\Container\Database\Request'       => 'Request',
        '\App\Container\Database\Row'           => 'Row',
        '\App\Container\Database\PID'           => 'PID',
        '\App\Container\Database\Integer'       => 'Integer',
        '\App\Container\Database\Varchar'       => 'Varchar',
        '\App\Container\Database\Boolean'       => 'Boolean',
        '\App\Container\Database\Timestamp'     => 'Timestamp',
        '\App\Container\Database\Migrations'    => 'Migrations',
        '\App\Auth\Account'                     => 'Account',

        // Routing
        '\App\Container\View'                   => 'View',
        '\App\Container\Routing\Direct'         => 'Direct',
        '\App\Container\Routing\Route'          => 'Route',
        '\App\Container\Routing\RouteHandler'   => 'RouteHandler',
        '\App\Container\Render'                 => 'Render',
        
        // Helpres

        '\App\Container\Helpers\Uploader'       => 'Uploader',
        '\App\Container\Helpers\Compressor'     => 'Compressor',
        '\App\Container\Helpers\Sorting'        => 'Sorting',
        '\App\Container\Helpers\Cache'          => 'Cache',
        '\App\Controllers\Controller'           => 'BaseController',

        // Interfaces
        
        'App\Container\Interfaces\ApiController'      => 'ApiController',
        'App\Container\Interfaces\Module'             => 'Module',
        'App\Container\Interfaces\StackController'    => 'StackController',
        'App\Container\Interfaces\NormalController'   => 'NormalController',
        
        // Traits
        
        'App\Container\Traits\IndexTrait'             => 'IndexTrait',
        'App\Container\Traits\MigrateTrait'           => 'MigrateTrait',
        
        // Modules
        
        '\App\Modules\User'                 => 'User',
        '\App\Modules\Category'             => 'Category',
        '\App\Modules\Image'                => 'Image',
        
    ];
    
    /**
     *  Constants
     */
    
    public static $constants = [
        'GET'      => 'get',
        'POST'     => 'post',
        'PUT'      => 'put',
        'PATCH'    => 'patch',
        'DELETE'   => 'delete',
        'ERROR'    => 'error',
    ];
}
