<?php

namespace App\Routing;

use Config;

class Direct extends Route{
    
    private $middleware = [];
    private $route = '';
    private $type = '';
    
    public function __construct($route, $callback, $type){
        $regex = "/(.*)\/(\\{(.*)\\})/uiUmx";
        
        $get = explode(",", preg_replace($regex, "$3,", $route));
        array_pop($get);
        
        $route = "/".trim(preg_replace($regex, "$1", $route), "/");
        
        $this->route = $route;
        $this->type = $type;
        parent::$routes[$type][$route] = [
                                    'callback' => Config::$controllers.$callback,
                                    'vars' => $get,
                                    'middleware' => [],
                                ];
    }
    
    /**
     * redirect to a page
     * @param string $page
     */
    public static function re($page){
        header("location: {$page}");
    }
    
    /**
     * Create a new Direct
     * @param  string  $a URI
     * @param  callback $b 
     * @return object   Direct Object
     * and so on...
     */
    public static function get($a, $b){
        
        return new Direct($a, $b, 'get');
    }
    
    public static function delete($a, $b){
        return new Direct($a, $b, 'delete');
    }
    
    public static function put($a, $b){
        return new Direct($a, $b, 'put');
    }
    
    public static function patch($a, $b){
        return new Direct($a, $b, 'patch');
    }
   
    public static function post($a, $b){
        return new Direct($a, $b, 'post');
    }
    
    public static function err($a, $b){
        return new Direct($a, $b, 'error');
    }
    
    
    
    public static function stack($url, $controller){
        
        //Overlook page
        self::get($url, "$controller@index");
        
        // Item Page
        self::get("$url/{id}", "$controller@item");
        
        // Delete page
        self::delete($url, "$controller@delete");
        
        //Edit page
        self::patch("$url/edit", "$controller@patch");
        self::get("$url/edit/{id}", "$controller@edit");
        
        // Update Page
        self::put("$url/create", "$controller@put");
    }
    
    public function Auth($callback = null){
        parent::$routes[$this->type][$this->route]['middleware']['auth'] = true;
        if(gettype($callback) == 'function' && $callback != null){
            parent::$routes[$this->type][$this->route]['middleware']['callback'] = $callback;
        }
    }
    
    public function Admin($callback = null){
        parent::$routes[$this->type][$this->route]['middleware']['auth'] = true;
        if(gettype($callback) == 'function' & $callback != null){
            parent::$routes[$this->type][$this->route]['middleware']['callback'] = $callback;
        }
    }
    
    /**
     * Gets called when a method on \App\Direct does not exist
     * @private
     * @param string $func 
     * @param string $args 
     */
    public function __call($func, $args){
        die($func."(".implode(', ', $args).") is not a method of ".__CLASS__);
    }
    
}