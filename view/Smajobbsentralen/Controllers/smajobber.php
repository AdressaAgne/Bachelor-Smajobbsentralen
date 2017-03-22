<?php

class smajobber {

	private $db;

	function __construct($db) {
		$this->db = $db;
	}

	public function get_cats(){

		return $this->db->all('kategorier');

	}

	public function get_smajobbere(){
		return $this->db->query("SELECT *
			FROM users as u WHERE u.visible >= 1
			AND u.approved >= 1
			AND u.id > 0
			ORDER BY u.name ASC")->fetchAll();
	}

	public function format_phonenr($nr){
		$new = preg_replace('/[^[:digit:]]/', '', $nr);

		preg_match('/(\d{3})(\d{2})(\d{3})/', $new, $matches);

		return "{$matches[1]} {$matches[2]} {$matches[3]}";
	}

	public function post($data){
		/*Bugger seg med "NAME" attributt fra kategorier table og users table TODO */
		$smajobbere = $this->db->query("SELECT u.name, u.surname, u.mobile_phone
		FROM users AS u
		LEFT JOIN user_category AS uc ON u.id = uc.user_id
		LEFT JOIN kategorier AS k ON uc.category_id = k.id
		WHERE uc.category_id = :id", [ 'id' => $data['_id']], 'User')->fetchAll();
		//skal virke men får sålangt ingen ID input fra ajax req

		return $smajobbere;


	}//sorting()

}
