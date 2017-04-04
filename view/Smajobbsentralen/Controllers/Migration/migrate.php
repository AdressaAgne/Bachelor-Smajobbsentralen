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

		$db->createTable('calendar', [
			new PID(),
			new Timestamp(),
			new Row('user_id', 'int'),
			new Row('year', 'int(4)', 2017),
			new Row('month', 'int(2)'),
			new Row('day', 'int(2)')
		]);
		
		$db->createTable('oppdrag', [
			new PID(),
			new Timestamp(),
			new Integer('user_id'),
			new Integer('cat_id'),
			new Varchar('from_time'),
			new Varchar('to_time'),
			new Integer('for_user_id'),
			new Integer('km', 0),
			new Boolean('hitch'),
			new Boolean('equipment'),
			new Row('info', 'text'),
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
			],
			[
				'permalink' => 'telefonvakt',
				'header' 	=> 'Telefonvakt Framside',
				'user_id' 	=> '0',
				'content' 	=> 'Telefonvakt Framside',
				'auth' 		=> '0',
				'visible' 	=> '1',
				'style' 	=> 'telefonvakt',
				'type' 		=> 'page',
				'image' 	=> '0',
				'arrangement' => '0'
			],
			[
				'permalink' => 'innstillinger',
				'header'	=> 'innstillinger for Telefonvakt',
				'user_id'   => '0',
				'content'	=> 'innstillinger framside',
				'auth'		=> '1',
				'visible'	=> '0',
				'style'		=> 'innstillinger',
				'type'		=> 'page',
				'image' 	=> '0',
				'arrangement' => '0'
			],
			[
				'permalink' => 'applications',
				'header'	=> 'Søknader',
				'user_id'   => '0',
				'content'	=> 'Søknader for å bli småjobber',
				'auth'		=> '1',
				'visible'	=> '0',
				'style'		=> 'applications',
				'type'		=> 'page',
				'image' 	=> '0',
				'arrangement' => '0'
			],
			[
				'permalink' => 'faktura',
				'header'	=> 'Faktura',
				'user_id'   => '0',
				'content'	=> 'Lag en fakura for en kunde',
				'auth'		=> '1',
				'visible'	=> '0',
				'style'		=> 'faktura',
				'type'		=> 'page',
				'image' 	=> '0',
				'arrangement' => '0'
			],
		]);
		$db->insert('calendar', [
			[
				'user_id' => '1',
				'year' => '2017',
				'month' => '3',
				'day' => '24'
			],[
				'user_id' => '2',
				'year' => '2017',
				'month' => '10',
				'day' => '30'
			],
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
			new Row('visible', 'tinyint', 1),
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

		$db->updateWhere('users',[
			'name' => 'admin',
			'surname' => 'adminsen',
			'approved' => '1',
			'visible' => '0',
			'dob' => '2017-03-16 20:16:28',
			'mobile_phone' => '47343090',
		], ['id' => $adminId]);


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
