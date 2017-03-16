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
				'header' => 'Småjobbere',
				'user_id' => '0',
				'content' => '',
				'auth' => '0',
				'visible' => '1',
				'parent' => '0',
				'style' => 'smajobber',
				'type' => 'post',
				'image' => '0',
				'arrangement' => '0'
			]
		]);
	}
}