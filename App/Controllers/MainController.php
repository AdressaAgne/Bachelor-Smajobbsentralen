<?php
namespace App\Controllers;

use View, NormalController;

class MainController extends Controller implements NormalController {

    use \MigrateTrait;
    
    public function index(){
        $id = $this->getSetting('frontpage');
        
        $page = $this->select('pages', ['*'], ['id' => $id], 'page')->fetch();

        return View::make('index', ['page' => $page]);
    }
}
