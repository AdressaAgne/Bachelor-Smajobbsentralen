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
            new Timestamp(),
            new Row('username', 'varchar'),
            new Row('password', 'varchar'),
            new Row('cookie', 'varchar'),
            new Row('image', 'int', '1'),
            new Row('mail', 'varchar'),
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
        
        $db->createTable('settings', [
            new PID(),
            new Row('name', 'var'),
            new Row('value', 'var'),
        ]);

        self::populate();
        return [$db->tableStatus];
    }

    public static function populate(){
        $db = new DB();
        $db->insert('pages', [
           [
               'permalink'  => 'home',
               'header'     => 'Welcome to your page',
               'content'    => 'This is the homepage of your site, you can edit this or make a new page in the admin panel',
               'user_id'    => '1',
               'auth'       => '0',
               'visible'    => '1',
               'parent'     => '0',
               'style'      => 'normal',
           ] 
        ]);
        
        $db->insert('settings', [
            [
                'name' => 'page-title',
                'value' => 'page',
            ],[
                'name' => 'sub-header',
                'value' => 'just another cms',
            ],[
                'name' => 'theme',
                'value' => 'basic',
            ],[
                'name' => 'meta-author',
                'value' => 'ball',
            ],[
                'name' => 'meta-description',
                'value' => 'lorem ipsum',
            ],[
                'name' => 'frontpage',
                'value' => '1',
            ],[
                'name' => 'comments',
                'value' => '1',
            ],
        ]);
        
    }
}
