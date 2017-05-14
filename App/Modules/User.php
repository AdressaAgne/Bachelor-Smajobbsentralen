<?php

namespace App\Modules;

use DB;


class User extends DB {
    
    
    public function __construct($id = null){
        
        if(!is_null($id)) {
            foreach ($this->select('users', ['*'], ['id' => $id])->fetch() as $key => $value) {
                $this->$key = $value;
            }
        }
    }
    
    public function get_oppdrag(){
        
        if(empty($this->oppdrag)){
            $this->oppdrag = $this->query('SELECT c.name, c.icon, o.tid, o.km, o.hitch, o.equipment, o.info, o.time FROM oppdrag AS o
                                           JOIN kategorier AS c ON c.id = o.cat_id
                                            WHERE o.user_id = :user_id
                                           GROUP BY o.id',
            ['user_id' => $_SESSION['uuid']])->fetchAll();
        }
        
        $priser = $this->all('settings');
        $priser = array_combine(array_column($priser, 'item_key'), array_column($priser, 'value'));
        $total = 0;
        foreach ($this->oppdrag as $key => &$value) {
            $pris = 0;
            // Times pris
            if($value['equipment'] == 1){
                $pris += ($value['tid'] / 60) * ($priser['hours'] + $priser['equipment']);
            } else {
                $pris += ($value['tid'] / 60) * $priser['hours'];
            }
            
            if($value['hitch'] == 1){
                $pris += $value['km'] * $priser['km_hitch'];
            } else {
                $pris += $value['km'] * $priser['km'];
            }
            
            $value['pris'] = (int)$pris;
            $total += (int)$pris;
        }
        
        
        return ['oppdrag' => $this->oppdrag, 'total' => $total];
        
    }
    
    public function get_work(){
        $work = $this->query('SELECT c.name FROM user_category AS u
                                 JOIN kategorier AS c ON c.id = u.category_id
                                 WHERE u.user_id = :id',
                                 ['id' => $this->id])->fetchAll();

        return array_column($work, 'name');
    }
    
    public function full_name(){
        return ucwords($this->name . ' ' . $this->surname);
    }
    
}