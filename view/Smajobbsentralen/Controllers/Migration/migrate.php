<?php

class Migrate {

	public function install($db) {

		$db->createTable('kategorier', [
			new PID(),
			new Timestamp(),
			new Row('name', 'varchar'),
			new Row('icon', 'varchar'),
		]);

		$db->createTable('opningstider', [
			new PID(),
			new Row('day', 'int'),
			new Row('from_time', 'varchar'),
			new Row('to_time', 'varchar'),
		]);

		$db->createTable('user_category', [
			new PID(),
			new Timestamp(),
			new Row('user_id', 'int'),
			new Row('category_id', 'int')
		]);

	}

	public function populate($db){
		$db->insert('kategorier', [
			[
				'name' => 'snømåking',
				'icon' => 'lock',
			],
			[
				'name' => 'hagearbeid',
				'icon' => 'user',
			],
			[
				'name' => 'kjøring',
				'icon' => 'user',
			],
			[
				'name' => 'gressklipping',
				'icon' => 'user',
			],
			[
				'name' => 'handling',
				'icon' => 'user',
			],
			[
				'name' => 'flytting',
				'icon' => 'user',
			],
			[
				'name' => 'maling',
				'icon' => 'user',
			],
			[
				'name' => 'møblering',
				'icon' => 'user',
			],
			[
				'name' => 'vasking',
				'icon' => 'user',
			],
			[
				'name' => 'småarbeid',
				'icon' => 'user',
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

		$db->insert('pages', [
			[
				'permalink' => 'smajobbere',
				'header' 	=> 'Småjobbere',
				'user_id' 	=> '0',
				'content' 	=> '',
				'auth' 		=> '0',
				'visible' 	=> '1',
				'style' 	=> 'smajobber',
				'type' 		=> 'page',
				'image' 	=> '0',
				'arrangement' => '0'
			],
			[
				'permalink' => 'blismajobber',
				'header' => 'Bli Småjobber',
				'user_id' => '0',
				'content' => '',
				'auth' => '0',
				'visible' => '1',
				'style' => 'blismajobber',
				'type' => 'page',
				'image' => '0',
				'arrangement' => '0'
			],
			[
				'permalink' => 'home',
				'header' => 'Småjobbsentralen',
				'user_id' => '0',
				'content' => 'Vi formidler rimelig hjelp til eldre og utføre',
				'auth' => '0',
				'visible' => '0',
				'style' => 'frontpage',
				'type' => 'page',
				'image' => '1',
				'arrangement' => '0'
			]
		]);
		$db->setSetting('frontpage', 4);
		
		$db->deleteTable('users');

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
			new Row('visible', 'tinyint'),
			new Row('dob', 'date'),
			new Row('mobile_phone', 'int'),
			new Row('private_phone', 'int'),
			new Row('car', 'tinyint'),
			new Row('hitch', 'tinyint'),
			new Row('occupation', 'varchar'),
			new Row('other_info', 'varchar')
		]);

		//register($username, $pw1, $pw2, $mail)
		
		$adminId = Account::register('admin', 'admin', 'admin', 'admin@admin.admin');
		
		$db->updateWhere('users', ['id' => $adminId], [
			'name' => 'admin',
			'surname' => 'adminsen',
			'approved' => '1',
			'visible' => '0',
			'dob' => '2017-03-16 20:16:28',
			'mobile_phone' => '47343090',
		]);
		

		$db->insert('user_category', [
			[
				'user_id' => 1,
				'category_id' => 5
			],
			[
				'user_id' => 2,
				'category_id' => 1
			],
			[
				'user_id' => 3,
				'category_id' => 5
			]
		]);
	}//populate
}//class
