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

	public function sorting($category){
		/*$query = $this->db->query("SELECT *
		FROM users");*/
		return 0;
	}
}
