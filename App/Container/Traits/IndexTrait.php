<?php

namespace App\Container\Traits;

use View;

/**
 * index trait, call this to add a basic index method thats returns a view for view/index.php
 *
 * @method index
 *
 * @author [Agne Ødegaard]
 *
 * @return [type] [description]
 */
trait IndexTrait {
    public function index(){
        return View::make('index');
    }
}