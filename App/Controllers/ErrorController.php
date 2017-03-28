<?php
namespace App\Controllers;

use View, NormalController, Config, Direct;

class ErrorController extends Controller implements NormalController {
    
    public function index(){
        return ['index'];
    }
    
    public function noaccess(){
        
        
        return ['ball'];
    }
}
