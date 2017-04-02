<?php

namespace App\Database;

use DB;

class Integer extends DB{
    
    public function toString($name, $default = null){
        return new Row($name, 'int', $default);
    }
    
}