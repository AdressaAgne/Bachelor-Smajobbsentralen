<?php

class blismajobber {

	private $db;

	function __construct($db) {
		$this->db = $db;
	}

	public function categories(){

		return $this->db->all('kategorier');

	}

	/**
	*	page/blismajobber put request
	*	form validation and insert to db
	*/
	public function put($data){
			
			
			
	}

}
