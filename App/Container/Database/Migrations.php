<?php

namespace App\Container\Database;

use DB, Account, Config, Direct;

class Migrations{

	public static function install(){
		//$name, $type, $default = null, $not_null = true, $auto_increment = false)
		
		$account = new Account();
		$account->logout();
		
		$db = new DB();

		// User Account
		$db->createTable('users', [
			new PID(),
			new Timestamp(),
			new Row('username', 'varchar'),
			new Row('cookie', 'varchar'),
			new Row('name', 'varchar'),
			new Row('surname', 'varchar'),
			new Row('mail', 'varchar'),
			new Row('password', 'varchar'),
			new Row('approved', 'tinyint', 0),
			new Row('visible', 'tinyint', 1),
			new Row('dob', 'int(4)'),
			new Row('mobile_phone', 'int'),
			new Row('address', 'varchar'),
			new Row('private_phone', 'int'),
			new Row('car', 'tinyint'),
			new Row('hitch', 'tinyint'),
			new Row('occupation', 'varchar'),
			new Row('other_info', 'varchar'),
			new Row('type', 'varchar', 0), //0 = oppdragstaker, 1 = tlfvakt, 2 = kunde
		]);

		$db->createTable('settings', [
			new PID(),
			new Varchar('value'),
			new Varchar('item'),
			new Row('item_key', 'varchar', null, true, false, 'UNIQUE'),
			new Timestamp(),
		]);

		 $db->createTable('image', [
			new PID(),
			new Row('user_id', 'int'),
			new Row('small', 'varchar'),
			new Row('big', 'varchar'),
			new Timestamp(),
		]);

		$db->createTable('kategorier', [
			new PID(),
			new Timestamp(),
			new Row('name', 'varchar'),
			new Row('icon', 'varchar'),
		]);

		$db->createTable('opningstider', [
			new PID(),
			new Row('day', 'int', null, true, false, 'UNIQUE'),
			new Row('from_time', 'varchar'),
			new Row('to_time', 'varchar'),
		]);

		$db->createTable('user_category', [
			new PID(),
			new Timestamp(),
			new Row('user_id', 'int'),
			new Row('category_id', 'int')
		]);

		$db->createTable('calendar', [
			new PID(),
			new Timestamp(),
			new Row('user_id', 'int'),
			new Row('description', 'text'),
			new Row('unix', 'varchar', null, true, false, 'UNIQUE'),
		]);
		
		$db->createTable('oppdrag', [
			new PID(),
			new Integer('time'),
			new Integer('user_id'),
			new Integer('cat_id'),
			new Varchar('tid'),
			new Integer('for_user_id'),
			new Integer('km'),
			new Boolean('hitch'),
			new Boolean('equipment'),
			new Row('info', 'text'),
		]);


		self::populate();
		
	
		return [$db->tableStatus];
	}

	public static function populate(){
		$db = new DB();

		$db->insert('kategorier', [
			[
				'name' => 'snømåking',
				'icon' => 'snowflake-o',
			],
			[
				'name' => 'hagearbeid',
				'icon' => 'tree',
			],
			[
				'name' => 'kjøring',
				'icon' => 'car',
			],
			[
				'name' => 'gressklipping',
				'icon' => 'leaf',
			],
			[
				'name' => 'handling',
				'icon' => 'shopping-cart',
			],
			[
				'name' => 'flytting',
				'icon' => 'truck',
			],
			[
				'name' => 'maling',
				'icon' => 'paint-brush',
			],
			[
				'name' => 'møblering',
				'icon' => 'suitcase',
			],
			[
				'name' => 'vasking',
				'icon' => 'shower',
			],
			[
				'name' => 'småarbeid',
				'icon' => 'wrench',
			],

		]);
		
		$db->insert('settings', [
			[
				'value' => 2.50,
				'item'  => 'Killometer', 
				'item_key'   => 'km', 
			],
			[
				'value' => 3,
				'item'  => 'Killomter Med Tilhenger', 
				'item_key'   => 'km_hitch', 
			],	
			[
				'value' => 100,
				'item'  => 'Timespris', 
				'item_key'   => 'hours', 
			],	
			[
				'value' => 30,
				'item'  => 'Eget Utstyr', 
				'item_key'   => 'equipment', 
			],		
			[
				'value' => '61 10 95 80',
				'item'  => 'Telefon Nummer', 
				'item_key'   => 'tlf', 
			],		
		]);

		//days starts on sunday = 0;
		$db->insert('opningstider', [
			[
				'day' => 2, // tirsdag
				'from_time' => '10:00',
				'to_time' => '12:00',
			],
			[
				'day' => 4, // torsdag
				'from_time' => '10:00',
				'to_time' => '12:00',
			],
		]);

		//register($username, $pw1, $pw2, $mail)

		$adminId = Account::register('admin', 'admin', 'admin', 'admin@admin.admin');
		$tlf = Account::register('tlf', 'tlf', 'tlf', 'tlf@tlf.tlf');
		$smajobber = Account::register('smajobber', 'smajobber', 'smajobber', 'smajobber@smajobber.smajobber');

		$db->updateWhere('users',[
			'name' => 'admin',
			'surname' => 'adminsen',
			'approved' => '1',
			'visible' => '0',
			'dob' => '2017-03-16 20:16:28',
			'mobile_phone' => '47343090',
			'type' => '3',
		], ['id' => $adminId]);
		$db->updateWhere('users',[
			'name' => 'tlf',
			'surname' => 'tellefonesen',
			'approved' => '1',
			'visible' => '0',
			'dob' => '2017-03-16 20:16:28',
			'mobile_phone' => '47343090',
			'type' => '1',
		], ['id' => $tlf]);
		$db->updateWhere('users',[
			'name' => 'smajobber',
			'surname' => 'jobberson',
			'approved' => '1',
			'visible' => '0',
			'dob' => '2017-03-16 20:16:28',
			'mobile_phone' => '47343090',
			'type' => '0',
		], ['id' => $smajobber]);

		$db->insert('users', [
			[
				'name' => 'per',
				'surname' => 'bjarneson',
				'type' => 1,
				'approved' => 1,
			]
		]);
		$db->insert('user_category', [
			[
				'user_id' => 1,
				'category_id' => 5
			]
		]);

	}
}
