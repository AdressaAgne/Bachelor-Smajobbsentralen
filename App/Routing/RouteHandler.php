<?php

namespace App\Routing;

use ErrorHandling, Config, Direct, Route;

class RouteHandler{
    
    private $route;
    private $url;
    
    /**
     * get the current url path
     * @author Agne *degaard
     * @return string 
     */
    protected function get_path(){
        return isset($_GET['param']) ? '/'.$_GET['param'] : '/';
    }
    
    /**
     * get array variables without key
     * @author Agne *degaard
     * @param  string $path 
     * @return array 
     */
    private function get_vars($path){
        $regex = $this->regexSlash($this->get_page());
        $str = preg_replace("/$regex/uimx", '', $this->get_path());
        $d = explode("/", trim($str, "/"));   
        
        //Direct::dd($this->get_path(), $str, $regex, $this->get_page());
        return $d;
    }
    
    /**
     * Convert / to \/ for regex
     * @author Agne *degaard
     * @param  string   $str
     * @return string
     */
    private function regexSlash($str){
        return preg_replace('/\//uimx', '\\\\/', $str);
    }
    
    /**
     * get the http method
     * @return [string] [PUT, PATCH, DELETE, GET, POST]
     */
    public function get_http_method(){
        return (isset($_POST['_method'])) ? strtolower($_POST['_method']) : 'get';
    }
    
    /**
     * Find the right page in the route array
     * @author Agne *degaard
     * @return array
     */
    protected function get_page(){
        $url = $this->get_path();
        
        $route = array_keys(Route::lists()[$this->get_http_method()]);
        
        if($url == '' || $url == '/') return $url;
        
        $route = array_filter($route, function($value) use($url) {
            return preg_match("/^".$this->regexSlash($value)."/i", $url);
        });
        
        $lengths = array_map('strlen', $route);
        $index = array_search(max($lengths), $lengths);
        
        return $route[$index];
    }
    
    public static function page(){
        $page = new self();
        return trim($page->get_page(), '/');
    }
    
    /**
     * get the page data from current url
     * @author Agne *degaard
     * @return string
     */
    public function getPageData(){
        return $this->callController($this->get_page());
    }
    
    /**
     * Get the Method to call
     * @author Agne *degaard
     * @return string 
     */
    protected function getMethod(){
        return new $this->view[0];
    }
    
    /**
     * Get the Class to call
     * @author Agne *degaard
     * @return string
     */
    protected function getClass(){
        return $this->view[1];
    }
    
    /**
     * Call the class to the right URL, from RouteSetup.php
     * @author Agne *degaard
     * @param  string   $url
     * @return string
     */
    private function callController($url){
        $this->route = Direct::getCurrentRoute($url);
        
        if(array_key_exists('error', $this->route)) return $this->route;
        
        $this->view = explode('@', $this->route['callback']);
        
        $vars = $this->extractVars($url);
        
        if(isset($vars['error'])) return Route::error('404', $vars);
        
        return call_user_func([$this->getMethod(), $this->getClass()], $vars);
    }
    
    /**
     * Extract Get variables from url, add correct key send them to $_GET
     * @author Agne *degaard
     * @param  integer  $url
     * @return array
     */
    private function extractVars($url){
        $vars = $this->route['vars'];
        $url = $this->get_vars($url);
        
        if(empty($url[0])) $url = [];
        
        if(count($vars) != count($url)){
            $vars = array_filter($vars, function($value){
                return !preg_match('/\?/', $value);
            });
            if(count($vars) != count($url)) return ['error' => 'Url does not match route variables', 'vars' => $vars, 'url' => $url];
        };
        
        $combined = array_combine(str_replace('?', '', $vars), $url);
        
        $params = !empty($vars) ? $combined : [];

        return array_merge($params, $_POST);
    }
}