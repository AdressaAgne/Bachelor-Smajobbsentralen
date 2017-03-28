<?php
namespace App\Controllers;

use View, NormalController, Config, Direct, Account;

class LoginController extends Controller implements NormalController {

    
    public function index(){
        return View::make('login');
    }
    
    //post on /login
    public function login($data){

        if($info = Account::login($data['username'], $data['password'], isset($data['rememberme']))){
            Direct::re('/admin');
        } else {
            View::make('login', ['info' => $info]);
        }
        
    }
    
    //get on /logout
    public function logout(){
        Account::logout();
        Direct::re('/');
    }
}
