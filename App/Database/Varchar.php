<?php

namespace App\Database;

use DB;

class varchar extends DB{
    
    public function toString($name, $default = null){
        return new Row($name, 'varchar', $default);
    }
    
}