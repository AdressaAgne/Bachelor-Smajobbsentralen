<?php

namespace App\Container\Database;

use DB;
/**
 * Return a new integer row to table
 *
 * @method __construct
 *
 * @author [Agne Ødegaard]
 *
 * @param  [string]      $name    [row name]
 * @param  string     $default    [default string value]
 */
class Integer extends DB{
    
    function __construct($name, $default = null){
        $this->name = $name;
        $this->default = $default;
    }
    
    public function toString(){
        return new Row($this->name, 'int', $this->default);
    }
    
}