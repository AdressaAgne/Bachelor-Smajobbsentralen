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
			FROM users WHERE visible = 1
			AND approved = 1
			AND id > 0
			ORDER BY name ASC")->fetchAll();
	}

	public function format_phonenr($nr){
		$new = preg_replace('/[^[:digit:]]/', '', $nr);

		preg_match('/(\d{3})(\d{2})(\d{3})/', $new, $matches);

		return "{$matches[1]} {$matches[2]} {$matches[3]}";
	}

	public function post($data){

		/*Bugger seg med "NAME" attributt fra kategorier table og users table TODO */
		$smajobbere = $this->db->query("SELECT u.name, u.surname, u.mobile_phone AS mobil, u.private_phone AS tlf
		FROM users AS u
		INNER JOIN user_category AS uc ON u.id = uc.user_id
		INNER JOIN kategorier AS k ON uc.category_id = k.id
		WHERE uc.category_id = :id AND u.approved = 1 AND u.visible = 1
		GROUP BY u.id
		ORDER BY u.name", [ 'id' => $data['_id']], 'User')->fetchAll();
		//skal virke men får sålangt ingen ID input fra ajax req

		return $smajobbere;


	}//sorting()

}
