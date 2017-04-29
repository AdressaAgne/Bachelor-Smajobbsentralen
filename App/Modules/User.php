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
            $this->oppdrag = $this->query('SELECT * FROM oppdrag AS o
                                           JOIN kategorier AS c ON c.id = o.cat_id
                                           GROUP BY o.id',
            ['user_id' => $_SESSION['uuid']])->fetchAll();
        }
        
        return array_filter($this->oppdrag, function($value){
            return $value['for_user_id'] == $this->id;
        });
        
    }
    
    public function get_work(){
        $work = $this->query('SELECT c.name FROM user_category AS u
                                 JOIN kategorier AS c ON c.id = u.category_id
                                 WHERE u.user_id = :id',
                                 ['id' => $this->id])->fetchAll();

        return array_column($work, 'name');
    }
    
}