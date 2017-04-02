<?php
namespace App\Controllers;

use View, NormalController, Config, Direct;

class MainController extends Controller implements NormalController {

    use \MigrateTrait;
    
    public function index(){
        
        
        $id = $this->getSetting('frontpage');
        
        $page = $this->select('pages', ['*'], ['id' => $id], 'page')->fetch();
    
        $controller = $this->callThemeController($page);
        if($controller[0]){
            return $controller[1];
        }

        return View::make('index', ['page' => $page]);
    }
    
    public function route(){
        return Direct::lists();
    }
    
    public function test($data){
        $this->insert('users', [
            [
                'name' => 'navn',
                'username' => 'navnesem',
            ],[
                'name' => 'navn2',
                'username' => 'navnesem2',
            ],
        ]);
        return [$data];
    }
    
    
}
