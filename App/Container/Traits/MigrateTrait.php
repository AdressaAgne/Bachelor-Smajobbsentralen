<?php

namespace App\Container\Traits;

use Migrations;

/**
 * call this to add a /migrate function to the controller
 *
 * @method migrate
 *
 * @author [Agne Ødegaard]
 *
 * @return [type]  [description]
 */
trait MigrateTrait {
    public function migrate(){
        return Migrations::install();
    }
}