<?php
namespace App\Controllers;

use View, NormalController, Config, Direct;

class MainController extends Controller implements NormalController {

    use \MigrateTrait;
    
    public function index(){
        $cats = $this->all('kategorier');
        return View::make('index', ['cats' => $cats]);
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
