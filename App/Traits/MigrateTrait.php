<?php

namespace App\Traits;

use Migrations;

trait MigrateTrait {
    public function migrate(){
        return Migrations::install();
    }
}