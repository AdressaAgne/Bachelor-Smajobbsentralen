<?php

namespace App\Traits;

use View;

trait IndexTrait {
    public function index(){
        return View::make('index');
    }
}