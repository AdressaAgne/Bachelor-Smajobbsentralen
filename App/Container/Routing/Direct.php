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
     * @param string $page
     */
    public static function re(string $page){
        header("location: {$page}");
    }
    
    /**
     * Die and dump
     * @param  any $param 
     * @return [die]        [kills the page and prints $parma[]]
     */
    public static function dd(...$param){
        @header('Content-type: application/json');
        die(print_r($param, true));
    }

    
    /**
     * Create a new Direct
     * @param  string  $a URI
     * @param  callback $b 
     * @return object   Direct Object
     * and so on...
     */
    public static function get(string $a, $b){
        return new Direct($a, $b, GET);
    }
    
    public static function delete(string $a, $b){
        return new Direct($a, $b, DELETE);
    }
    
    public static function put(string $a, $b){
        return new Direct($a, $b, PUT);
    }
    
    public static function patch(string $a, $b){
        return new Direct($a, $b, PATCH);
    }
   
    public static function post(string $a, $b){
        return new Direct($a, $b, POST);
    }
    
    public static function error(string $a, $b){
        return new Direct($a, $b, ERROR);
    }
    
    public static function all(string $a, $b){
        foreach ([GET, POST, PATCH, PUT, DELETE] as $value) {
            call_user_func_array("Direct::$value", [$a, $b]);
        }
    }
    
    public static function on(array $http, string $a, $b) {
        foreach ($http as $value) {
            if(!in_array($value, [GET, POST, PATCH, PUT, ERROR, DELETE])) continue;
            call_user_func_array("Direct::$value", [$a, $b]);
        }
    }
    
    
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
    
    
    public function Authenticate($grade, $callback){
        $auth = &parent::$routes[$this->type][$this->route]['filter'];
        
        $auth['auth'] = true;
        $auth['grade'] = $grade;
        
        if(is_callable($callback)){
            $auth['callback'] = $callback;
        } else {
            $auth['callback'] = function(){
                Direct::re('/login');
            };
        }

    }
    
    public function cache(){
        $filter = &parent::$routes[$this->type][$this->route]['filter'];
        
        $filter['cache'] = true;
    }
    
    public function Auth($callback = null){
        self::Authenticate(3, $callback);
        return $this;
    }
    
    public function Mod($callback = null){
        self::Authenticate(2, $callback);
        return $this;
    }
    
    public function Admin($callback = null){
        $this->Authenticate(1, $callback);
        return $this;
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