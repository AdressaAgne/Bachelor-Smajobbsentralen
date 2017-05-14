<?php

namespace App\Container\Database;

use DB;

/**
 * Return a new boolean row to table
 *
 * @method __construct
 *
 * @author [Agne Ødegaard]
 *
 * @param  [string]      $name    [row name]
 * @param  string     $default    [default string value]
 */
class Boolean extends DB{
    
    function __construct($name, $default = 0){
        $this->name = $name;
        $this->default = $default;
    }
    
    public function toString(){
        return new Row($this->name, 'bool', $this->default);
    }
    
}