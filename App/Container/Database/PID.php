<?php

namespace App\Container\Database;

use DB;
/**
 * Return a new Primary ID row to table
 *
 * @method __construct
 *
 * @author [Agne Ødegaard]
 *
 */
class PID extends DB{
    
    public function toString(){
        return new Row('id', 'int', null, true, true);
    }
    
}