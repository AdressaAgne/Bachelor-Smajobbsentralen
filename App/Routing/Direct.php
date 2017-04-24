<?php

namespace App\Routing;

use Config;

class Direct extends Route{
    
    private $middleware = [];
    private $route = '';
    private $type = '';
    
    const GET     = 'get';
    const POST    = 'post';
    const PUT     = 'put';
    const PATCH   = 'patch';
    const DELETE  = 'delete';
    
    public function __construct(string $route, $callback, $type){
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
            'middleware' => [],
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

        return new Direct($a, $b, self::GET);
    }
    
    public static function delete(string $a, $b){
        return new Direct($a, $b, self::DELETE);
    }
    
    public static function put(string $a, $b){
        return new Direct($a, $b, self::PUT);
    }
    
    public static function patch(string $a, $b){
        return new Direct($a, $b, self::PATCH);
    }
   
    public static function post(string $a, $b){
        return new Direct($a, $b, self::POST);
    }
    
    public static function err(string $a, $b){
        return new Direct($a, $b, 'error');
    }
    
    
    
    public static function stack(string $url, string $controller){
        //Overlook page
        self::get($url, "$controller@index");
        
        // Item Page
        self::get("$url/{id}", "$controller@item");
        
        // Delete page
        self::delete($url, "$controller@delete")->admin();
        
        //Edit page
        self::patch("$url/edit", "$controller@patch")->admin();
        self::get("$url/edit/{id}", "$controller@edit")->admin();
        
        // Update Page
        self::put("$url/create", "$controller@put")->admin();
    }
    
    
    public function Authenticate($grade, $callback){
        $auth = &parent::$routes[$this->type][$this->route]['middleware'];
        
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