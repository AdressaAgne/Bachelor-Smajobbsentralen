<?php
namespace App\Container\Routing;

use Config;

class Route {
    
    public static $routes = [
        GET       => [],
        POST      => [],
        PATCH     => [],
        PUT       => [],
        DELETE    => [],
        ERROR     => [],
    ];
    
    /**
     * get the current route for the page the suer is on.
     *
     * @method getCurrentRoute
     *
     * @author [Agne Ødegaard]
     *
     * @param  [type]          $route [description]
     *
     * @return current page, route and filters
     */
    public static function getCurrentRoute($route){
        
        Config::$route = $route;
        
        if(Config::$debug_mode){
            self::checkForMissingMethods();
        }
        
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            //CSRF token
            if(!isset($_POST['_token'])) return self::set_error('401', ['Missing token']);
            
            if($_POST['_token'] != $_SESSION['_token']){
               return self::set_error('401', ['Wrong CSRF token']);
            } 

            switch(strtoupper($_POST['_method'])) {
                    
                case PUT:
                    return self::method(PUT, $route);
                break;

                case PATCH:
                    return self::method(PATCH, $route);
                break;

                case DELETE:
                    return self::method(DELETE, $route);
                break;
              
                case POST:
                    return self::method(POST, $route);
                break;

                default:
                    return self::set_error('405');
                break;
            }
        } else {
            return self::method(GET, $route);
        }
    }
    
    /**
     * check if there is any missing controller methods, that is not defined
     *
     * @method checkForMissingMethods
     *
     * @author [Agne Ødegaard]
     *
     * @return [array]                 [contains data about the missing controlelrs]
     */
    private static function checkForMissingMethods(){
        $missing = [];
            
        foreach(self::$routes as $key => $http){
            foreach($http as $class){
                if(gettype($class['callback']) == 'string') {
                    $class = explode('@', $class['callback']);
                    if(count($class) == 2 && !method_exists($class[0], $class[1])){
                        $missing[] = $class;
                    }
                }
            }
        }
        if(!empty($missing)){
            print_r($missing);
            die("Missing controllers");
        }
    }
    
    /**
     * check a route and method exists
     *
     * @method method
     *
     * @author [Agne Ødegaard]
     *
     * @param  [string] $method [get, post, put, patch, delete]
     * @param  [string] $route  [/route/name]
     *
     * @return [array] the current route
     */
    public static function method($method, $route){
        
        if(array_key_exists($route, self::$routes[$method])){
            $key = self::$routes[$method][$route];
            
            if(isset($key['filter']['auth'])){
                if(!isset($_SESSION['uuid'])){
                    if(isset($key['filter']['callback'])){
                        return call_user_func($key['filter']['callback']);   
                    }
                    return self::set_error('403', 'No entry, premission denied');   
                }
            }
            return self::$routes[$method][$route];
        } else {
            return self::set_error('404', ['error' => 'page does not exist', 'Route' => $route, 'Method' => $method, 'post' => $_POST]);
        }
    }
    
    /**
     * check if the error page exists and return it.
     *
     * @method set_error
     *
     * @author [Agne Ødegaard]
     *
     * @param  [integer]    $error [404, 401, 503 etc..]
     * @param  string    $route [url route]
     */
    public static function set_error($error, $route = ''){
        
        return array_key_exists($error, self::$routes[ERROR]) ? self::$routes[ERROR][$error] : ['error' => "$error: Please set up a $error page", 'trace' => $route];
        
    }
    
    
    public static function lists(){
        return self::$routes;
    }
}