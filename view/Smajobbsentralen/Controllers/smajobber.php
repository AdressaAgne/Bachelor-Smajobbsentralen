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

	public function sorting($cat_id){
		$smajobbere = $this->db->query("SELECT *
		FROM users AS u
		INNER JOIN user_category AS uc ON uc.user_id = u.id
		INNER JOIN kategorier AS k ON k.id = :id", ['id' => $cat_id], 'User')->fetchAll();

		return View::make('smajobbere/sort', ['smajobbere' => $smajobbere]);
	}//sorting()

}
