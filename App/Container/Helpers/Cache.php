<?php

namespace App\Container\Helpers;

use Config, RouteHandler;

/**
 *  
 */
class Cache extends RouteHandler {
    
    private $cached_file_name;
    
    function __construct() {
        $this->cached_file_name = Config::$cache_folder.'cached_';
        $this->cached_file_name .= trim(str_replace('/', '_', $this->get_path()), '.').".html";
    }
    
    /**
     * check if the page has a chached file
     *
     * @method has_cached_file
     *
     * @author [Agne Ødegaard]
     *
     * @return boolean         [description]
     */
    public function has_cached_file(){
        return file_exists($this->cached_file_name) && (filemtime($this->cached_file_name) + Config::$cache_time > time());
    }

    /**
     * get the cached file if it exists
     *
     * @method get_cached_file
     *
     * @author [Agne Ødegaard]
     *
     * @return [type]          [description]
     */
    public function get_cached_file(){
        if($this->has_cached_file()) return file_get_contents($this->cached_file_name);
    }
    
    /**
     * write a new file to cahche
     *
     * @method cache_file
     *
     * @author [Agne Ødegaard]
     *
     * @param  string     $data [file content]
     *
     * @return [type]           [description]
     */
    public function cache_file(string $data){
        $this->make_cache_folder();
        
        $file = fopen($this->cached_file_name, 'w');
        
        $w = fwrite($file, "<!--- Cached Version ".date('H:i:s - d/m/y', time())." --->\n".$data);
        
        fclose($file);
    }
    
    /**
     * make the chache folder if it does not exist
     *
     * @method make_cache_folder
     *
     * @author [Agne Ødegaard]
     *
     * @return [type]            [description]
     */
    public function make_cache_folder(){
        if(!file_exists(Config::$cache_folder)){
            mkdir(Config::$cache_folder, 0777, true);
        }
    }
    
}
