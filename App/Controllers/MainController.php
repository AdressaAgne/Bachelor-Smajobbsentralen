<?php
namespace App\Controllers;

use View, NormalController, Config, Direct;

class MainController extends Controller implements NormalController {

    use \MigrateTrait;
    
    public function index(){
        return View::make('index', [
            'cats' => $this->all('kategorier'),
        ]);
    }
    
    public function om(){
        return View::make('om');
    }
    
    
    public function route(){
        return Direct::lists();
    }
    
    public function test($data){
        return [$data];
    }
    
    
}
