<?php

namespace App\Container\Routing;

use Config;

class Direct extends Route{
    
    private $middleware = [];
    private $route = '';
    private $type = '';
    
    
    public function __construct(string $route, $callback, string $type){
        
        $regex = "/([a-zA-Z0-9*])\/(\{(.*)\})/";

        $var_regex = '/\{(.*?)\}/';
        
        preg_match_all($var_regex, $route, $vars);
        
        $route = preg_replace($regex, "$1", $route);
        
        $this->route = $route;
        $this->type = $type;
    
        $callback = (gettype($callback) == 'string') ? Config::$controllers.$callback : $callback;
        
        parent::$routes[$type][$route] = [
            'callback' => $callback,
            'vars' => $vars[1],
            'filter' => [],
        ];

    }
    
    /**
     * redirect to a page
     *
     * @method re
     *
     * @author [Agne Ødegaard]
     *
     * @param  string $page [url]
     *
     * @return void
     */
    public static function re(string $page){
        header("location: {$page}");
    }
    

    /**
     * add an get route
     *
     * @method get
     *
     * @author [Agne Ødegaard]
     *
     * @param  string $a [url]
     * @param  [string|callable] $b    [controller@method | callable function]
     *
     * @return new self
     */
    public static function get(string $a, $b){
        return new Direct($a, $b, GET);
    }
    
    /**
     * add an delete route
     *
     * @method delete
     *
     * @author [Agne Ødegaard]
     *
     * @param  string $a [url]
     * @param  [string|callable] $b    [controller@method | callable function]
     *
     * @return new self
     */
    public static function delete(string $a, $b){
        return new Direct($a, $b, DELETE);
    }
    
    /**
     * add an put route
     *
     * @method put
     *
     * @author [Agne Ødegaard]
     *
     * @param  string $a [url]
     * @param  [string|callable] $b    [controller@method | callable function]
     *
     * @return new self
     */
    public static function put(string $a, $b){
        return new Direct($a, $b, PUT);
    }
    
    /**
     * add an patch route
     *
     * @method patch
     *
     * @author [Agne Ødegaard]
     *
     * @param  string $a [url]
     * @param  [string|callable] $b    [controller@method | callable function]
     *
     * @return new self
     */
    public static function patch(string $a, $b){
        return new Direct($a, $b, PATCH);
    }
   
    /**
     * add an post route
     *
     * @method post
     *
     * @author [Agne Ødegaard]
     *
     * @param  string $a [url]
     * @param  [string|callable] $b    [controller@method | callable function]
     *
     * @return new self
     */
    public static function post(string $a, $b){
        return new Direct($a, $b, POST);
    }
    
    /**
     * add an error route
     *
     * @method error
     *
     * @author [Agne Ødegaard]
     *
     * @param  string $a [url]
     * @param  [string|callable] $b    [controller@method | callable function]
     *
     * @return new self
     */
    public static function error(string $a, $b){
        return new Direct($a, $b, ERROR);
    }
    
    /**
     * add a route if debugmode is on
     *
     * @method debug
     *
     * @author [Agne Ødegaard]
     *
     * @param  string $a    [route]
     * @param  [string|callable] $b    [controller@method | callable function]
     * @param  [string] $http [methods]
     *
     * @return $this
     */
    public static function debug(string $a, $b, array $http = [GET]){
        if(Config::$debug_mode) return self::on($http, $a, $b);
    }
    
    /**
     * Add a route for all methods
     *
     * @method all
     *
     * @author [Agne Ødegaard]
     *
     * @param  string $a [url]
     * @param  [string | callable] $b [controller@method | callable function]
     *
     * @return void
     */
    public static function all(string $a, $b){
        foreach ([GET, POST, PATCH, PUT, DELETE] as $value) {
            call_user_func_array("Direct::$value", [$a, $b]);
        }
    }
    
    /**
     * add a route to all defined methods
     *
     * @method on
     *
     * @author [Agne Ødegaard]
     *
     * @param  array  $http [methods]
     * @param  string $a    [url]
     * @param  [string | callable] $b [controller@method | callable function]
     *
     * @return [type]       [description]
     */
    public static function on(array $http, string $a, $b) {
        foreach ($http as $value) {
            if(!in_array($value, [GET, POST, PATCH, PUT, ERROR, DELETE])) continue;
            call_user_func_array("Direct::$value", [$a, $b]);
        }
    }
    
    /**
     * generate routes for CRUD
     *
     * @method stack
     *
     * @author [Agne Ødegaard]
     *
     * @param  string $url        [url]
     * @param  string $controller [controller]
     *
     * @return void
     */
    public static function stack(string $url, string $controller){
        //Overlook page
        self::get($url, "$controller@index");
        
        // Item Page
        self::get("$url/{id}", "$controller@item");
        
        // Delete page
        self::delete($url, "$controller@delete")->auth();
        
        //Edit page
        self::patch("$url/edit", "$controller@patch")->auth();
        self::get("$url/edit/{id}", "$controller@edit")->auth();
        
        // Update Page
        self::put("$url/create", "$controller@put")->auth();
    }
    
    /**
     * add a filer/middleware to a route
     *
     * @method add_filter
     *
     * @author [Agne Ødegaard]
     *
     * @param  string     $key   [filter key]
     * @param  [string]     $value [filter value, can be callable]
     */
    private function add_filter(string $key, $value){
        parent::$routes[$this->type][$this->route]['filter'][$key] = $value;
        return $this;
    }
    
    /**
     * Add Authenticatin to a route
     *
     * @method Authenticate
     *
     * @author [Agne Ødegaard]
     *
     * @param  [grade]       $grade    [1-infinity]
     * @param  [callable]       $callback [callback for whats gonna happen if rank is not met]
     */
    private function Authenticate($grade, callable $callback = null){        
        $this->add_filter('auth', true);
        $this->add_filter('grade', $grade);
        
        if(is_callable($callback)) $this->add_filter('callback', $callback);
        
        return $this->add_filter('callback', function(){
            Direct::re('/login');
        });
    }
    
    /**
     * add a cache filter to route
     *
     * @method Cache
     *
     * @author [Agne Ødegaard]
     *
     * @param  [callable] $callable [add cahceh if callable = true]
     */
    public function Cache(callable $callable = null){
        if(is_callable($callable) && call_user_func($callable)) return $this->add_filter('cache', true);
        if(!is_callable($callable)) return $this->add_filter('cache', true);
    }
    
    /**
     * Add Authentication to route that matches the rank of 1
     *
     * @method Auth
     *
     * @author [Agne Ødegaard]
     *
     * @param  [callback] $callback [callback runs if user does not match contraints]
     */
    public function Auth($callback = null){
        return $this->Authenticate(1, $callback);
    }
    
    /**
     * Add Authentication to route that matches the rank of 2
     *
     * @method Mod
     *
     * @author [Agne Ødegaard]
     *
     * @param  [callback] $callback [callback runs if user does not match contraints]
     */
    public function Mod($callback = null){
        return $this->Authenticate(2, $callback);
    }
    
    /**
     * Add Authentication to route that matches the rank of 3
     *
     * @method Admin
     *
     * @author [Agne Ødegaard]
     *
     * @param  [callback] $callback [callback runs if user does not match contraints]
     */
    public function Admin($callback = null){
        return $this->Authenticate(3, $callback);
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