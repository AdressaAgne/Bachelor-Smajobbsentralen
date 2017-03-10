<?php
namespace App;

use \App\Routing\Direct             as Direct;
use \App\Routing\Route              as Route;
use \App\Routing\RouteHandler       as RouteHandler;
use \App\Config                     as Config;
use \App\Controllers\ErrorHandling  as ErrorHandling;

// Start a session if it does not exist
if(!isset($_SESSION)){
    session_start();
}

// Generate a new PHP Session ID to prevent session hijacking.
session_regenerate_id();

/**
 * SPL autoloader, so we dont need to include files everywhere
 * @author Agne *degaard
 * @param function function($class)
 */
spl_autoload_register(function($class){
    $file = implode('/', explode('\\', "{$class}.php"));
    if(file_exists($file)){
        require_once($file);
    }
});

// Setting up aliases
foreach(Config::$aliases as $key => $value){
    class_alias($key, $value);
}


// Adding routing
require_once('App/Routing/RouteSetup.php');

// Start Route Handling
class App extends RouteHandler{

    public function __construct(){

        // CSRF token - Cross-site Request Forgery
        if (!isset($_SESSION['_token'])){
            $_SESSION['_token'] = uniqid();
            Config::$form_token = $_SESSION['_token'];
        }
        
        $cached_file = './'.Config::$cache_folder.'cached_';
        $cached_file .= trim(preg_replace('/\//u', '_', $this->get_path()), '.').".html";
        
        if(!isset($_SESSION['uuid']) && $_SERVER['REQUEST_METHOD'] != "POST" && Config::$debug_mode == false && file_exists($cached_file) && (filemtime($cached_file) + Config::$cache_time > time())){
            
            echo file_get_contents($cached_file);
            
        } else {
            $page = $this->getPageData();
            
            if(gettype($page) !== 'string'){
                
                @header('Content-type: application/json');
                echo json_encode($page, JSON_UNESCAPED_UNICODE);
                return;
                
            } else {
                
                // Echo out the rendered code
                echo $page;
                
                // save cached file
                if(Config::$debug_mode == false && $_SERVER['REQUEST_METHOD'] != "POST" && !isset($_SESSION['uuid'])){
                    if(!file_exists(Config::$cache_folder)){
                        mkdir(Config::$cache_folder, 0777, true);
                    }

                    $file = fopen($cached_file, 'w');
                    $w = fwrite($file, "<!--- Cached Version ".time()." --->\n".$page);
                    fclose($file);
                }
            }
        }
    }
}

new App();
