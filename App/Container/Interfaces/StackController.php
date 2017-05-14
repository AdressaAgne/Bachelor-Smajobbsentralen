<?php

namespace App\Container\Interfaces;
    
/**
 * an interface for a CRUD controller
 *
 * @method index
 *
 * @author [Agne Ødegaard]
 *
 * @return [type] [description]
 */
interface StackController {
    
    public function index();
    
    public function item($url);
    
    public function put($data);
    
    public function patch($data);
    
    public function edit($url);
    
    public function delete($data);
}