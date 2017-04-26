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
    
    
}