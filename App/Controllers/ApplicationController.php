<?php

namespace App\Controllers;

use View, NormalController, Config, Direct;

class ApplicationController extends Controller{
    
    public function index(){
        $applications = $this->query('SELECT * from users WHERE approved = 0 ORDER BY time DESC', 'User')->fetchAll();
        
        return View::make('applications', ['applications' => $applications]);
        
    }
    

    public function patch($data){

        return $this->updateWhere('users', ['approved' => 1], ['id' => $data['user_id']]);
    }

    public function delete($data){

        if($this->deleteWhere('users', 'id', $data['user_id'])){
            return $this->db->deleteWhere("user_category", "user_id", $data['user_id']);
        }
    }
    
}