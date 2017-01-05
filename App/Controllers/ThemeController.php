<?php
namespace App\Controllers;

use View, NormalController, Route;


class ThemeController extends Controller implements NormalController {

    
    public function index(){
        
        return View::make('admin.themes');
        
    }
}
