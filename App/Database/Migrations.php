<?php

namespace App\Database;

use DB, Account;

class Migrations{

    public static function install(){
        //$name, $type, $default = null, $not_null = true, $auto_increment = false)
        $db = new DB();

        // User Account
        $db->createTable('users', [
            new PID(),
            new Row('username', 'varchar'),
            new Row('password', 'varchar'),
            new Row('cookie', 'varchar'),
            new Row('image', 'int', '1'),
            new Row('mail', 'varchar'),
            new Timestamp(),
        ]);
        
        $db->createTable('pages', [
            new PID(),
            new Timestamp(),
            new Row('permalink', 'var'),
            new Row('header', 'var'),
            new Row('content', 'text'),
            new Row('user_id', 'int'),
            new Row('auth', 'bool'),
            new Row('visible', 'bool'),
            new Row('parent', 'int', '0'),
            new Row('style', 'var', 'normal'),
        ]);

        self::populate();
        return [$db->tableStatus];
    }

    public static function populate(){
        $db = new DB();
        $db->insert('pages', [
           [
               'permalink'  => 'lorem',
               'header'     => 'lorem ipsum',
               'content'    => 'lorem ipsum page cotent',
               'user_id'    => '1',
               'auth'       => '0',
               'visible'    => '1',
               'parent'     => '0',
               'style'      => 'normal',
           ] 
        ]);
        
    }
}
