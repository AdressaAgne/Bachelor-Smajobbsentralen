<?php

namespace App\Database;

use DB;

class Boolean extends DB{
    
    public function toString($name, $default = 0){
        return new Row($name, 'bool', $default);
    }
    
}