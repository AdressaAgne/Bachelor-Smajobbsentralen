<?php

class blismajobber {

	private $db;
	private $page;

	function __construct($db, $page) {
		$this->db = $db;
		$this->page = $page;
	}

	public function categories(){

		return $this->db->all('kategorier');

	}

	/**
	*	page/blismajobber put request
	*	form validation and insert to db
	*/
	public function put($data){
		return (View::make('index', ['page' => $this->page, 'class' => $this]));
	}

}
