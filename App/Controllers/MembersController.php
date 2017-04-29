<?php

namespace App\Controllers;

use View, NormalController, Config, Direct, Request;

class MembersController extends Controller {
    
    public function get_application(){
        return $this->query("SELECT *
            FROM users WHERE visible = 1
            AND approved = 0
            AND id > 0
            ORDER BY name ASC")->fetchAll();
    }
    
    public function kunder(){
        return View::make('kunder');
    }
    
    public function faktura(){
        return View::make('faktura', ['members' => $this->get_members()]);
    }
    
    public function new_member($data){
        
        $id = $this->insert('users', [
            [
                'name'            => $data['name'],    
                'approved'        => 1,    
                'visible'         => 0,    
                'type'            => 2,
                'mobile_phone'    => $data['mobile'],    
                'private_phone'   => $data['private'],    
                'other_info'      => $data['info'],    
                'address'         => $data['address'],    
            ]
        ]);
        
        return Direct::re('/faktura');
    }
    
    public function get_members(){
        return $this->select('users', ['*'], ['type' => 2], 'User')->fetchAll();    
    }
    
    public function delete_member(Request $request){
        
        $this->deleteWhere('users', 'id', $request->post->kunde_id);
        
        return Direct::re('/faktura');
    }
    
    public function new_faktura($data){
        
        $this->insert('oppdrag', [[
            'user_id'         => $_SESSION['uuid'],
            'cat_id'          => $data['cat_id'],
            'tid'             => $data['time'],
            'for_user_id'     => $data['for_user_id'],
            'km'              => $data['km'],
            'hitch'           => isset($data['hitch']),
            'equipment'       => isset($data['equipment']),
            'info'            => $data['info'],
            'time'            => time(),
        ]]);
        
        return Direct::re('/faktura');
    }
    
}