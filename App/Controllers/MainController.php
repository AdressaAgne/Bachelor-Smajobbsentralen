<?php
namespace App\Controllers;

use View, NormalController, Config;

class MainController extends Controller implements NormalController {

    use \MigrateTrait;
    
    public function index(){
        
        
        $id = $this->getSetting('frontpage');
        
        $page = $this->select('pages', ['*'], ['id' => $id], 'page')->fetch();
    
        //check if a designated controller for the view file exists, if so call it and pass it to the file.
        $theme = '/view/'.Config::$theme;
        $controller = '.'.$theme.'/Controllers/'.$page->style.'.php';
        
        if(file_exists($controller)){
            include_once($controller);
            return View::make('index', ['page' => $page, 'class' => new $page->style($this, $page)]);
        }

        return View::make('index', ['page' => $page]);
    }
}
