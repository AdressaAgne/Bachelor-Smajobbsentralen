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
	}

	public function populate($db){
		$db->insert('kategorier', [
			[
				'name' => 'snømåking',
				'icon' => 'user',
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
				'parent' 	=> '0',
				'style' 	=> 'smajobber',
				'type' 		=> 'post',
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
				'parent' => '0',
				'type' => 'page',
				'style' => 'blismajobber',
				'image' => '0',
				'arrangement' => '0'
			]
		]);

		$db->deleteTable('users');

		$db->createTable('users', [
			new PID(),
			new Timestamp(),
			new Row('name', 'varchar'),
			new Row('surname', 'varchar'),
			new Row('email', 'varchar'),
			new Row('password', 'varchar'),
			new Row('approved', 'tinyint'),
			new Row('visible', 'tinyint'),
			new Row('dob', 'date'),
			new Row('mobile_phone', 'int'),
			new Row('private_phone', 'int'),
			new Row('car', 'tinyint'),
			new Row('hitch', 'tinyint'),
			new Row('occupation', 'varchar'),
			new Row('other_info', 'varchar')
		]);


		$db->insert('users', [
			[
				'name' => 'admin',
				'surname' => 'adminsen',
				'email' => 'admin@admin.admin',
				'password' => 'admin',
				'approved' => '1',
				'visible' => '1',
				'dob' => '2017-03-16 20:16:28',
				'mobile_phone' => '47343090',

			],
			[
				'name' => 'heis',
				'surname' => 'sann',
				'email' => 'skji@ss.admin',
				'password' => '123',
				'approved' => '1',
				'visible' => '1',
				'dob' => '2017-03-16 20:16:28',
				'mobile_phone' => '12341234',
			]
		]);
	}//populate
}//class
