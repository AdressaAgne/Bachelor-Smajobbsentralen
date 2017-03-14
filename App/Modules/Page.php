<?php

namespace App\Modules;

use DB, Module, Sorting;


class Page extends DB implements Module {
    
    
    public function __construct(){
        
        
        
    }
    
    public function children(){
        $children = $this->select('pages', ['*'], ['parent' => $this->id], 'page')->fetchAll();
        Sorting::pages($children, 'asc');
        
        return $children;
        
    }
    
    public function image(){
        return $this->select('image', ['*'], ['id' => $this->image], 'image')->fetch();
    }
}