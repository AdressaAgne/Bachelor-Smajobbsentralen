<?php

namespace App\Container\Database;

use DB;
/**
 * Return a new timestamp row to table
 *
 * @method __construct
 *
 * @author [Agne Ødegaard]
 *
 * @param  [string]      $name    [row name]
 * @param  string     $default    [default string value]
 */
class Timestamp extends DB{
    
    public function toString(){
        return "`time` TIMESTAMP DEFAULT CURRENT_TIMESTAMP";
    }
    
}