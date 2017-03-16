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

		$db->deleteTable('users');

		$db->insert('');



	}//populate


}




/*
-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: 16. Mar, 2017 19:57 PM
-- Server-versjon: 5.6.34
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `smajobb`
--

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `password` varchar(255) NOT NULL,
  `cookie` varchar(255) NOT NULL,
  `image` int(11) NOT NULL DEFAULT '1',
  `mail` varchar(255) NOT NULL,
  `visible` tinyint(11) NOT NULL,
  `approved` tinyint(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `mobile` int(11) NOT NULL,
  `phone` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dataark for tabell `users`
--

INSERT INTO `users` (`id`, `time`, `password`, `cookie`, `image`, `mail`, `visible`, `approved`, `name`, `surname`, `mobile`, `phone`) VALUES
(1, '2017-03-16 15:47:38', '123', '', 1, 'asd@asd.asd', 1, 1, 'øyvind', 'skjiitsek', 47343090, 47343090),
(2, '2017-03-16 15:54:28', '123', '', 1, '123@123.cm', 1, 1, 'agnis', 'agnos', 12341234, 12341234);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
*/
