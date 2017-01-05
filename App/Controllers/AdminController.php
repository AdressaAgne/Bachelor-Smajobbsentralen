<?php
namespace App\Controllers;

use View, NormalController, Route;


class AdminController extends Controller implements NormalController {

    
    public function index(){
        
        return View::make('admin');
        
    }
    
    
    public function route(){
        return Route::lists();
    }
}