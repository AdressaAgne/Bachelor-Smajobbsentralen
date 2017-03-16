<?php

class blismajobber {

	private $db;

	function __construct($db) {
		$this->db = $db;
	}

	public function categories(){

		return $this->db->all('kategorier');

	}

}
