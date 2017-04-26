<?php
namespace App\Controllers;

use View, NormalController, Config, Direct, Account, Request;

class LoginController extends Controller implements NormalController {

    
    public function index(){
        return View::make('login');
    }
    
    //post on /login
    public function login(Request $data){

        if($info = Account::login($data->post->username, $data->post->password, isset($data->post->rememberme))){
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
