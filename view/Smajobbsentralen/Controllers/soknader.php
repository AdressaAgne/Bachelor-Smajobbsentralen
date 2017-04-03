<?php

class Soknader{

    public function construct($db){
        $this->db = $db;
    }

	public function getAwaitingUsers(){
		return $this->db->query("SELECT *
			FROM users as u WHERE
			u.approved = 0
			ORDER BY u.name ASC")->fetchAll();
	}

	public function approveOrDeclineUser($data){
		return $this->db->update(['approved' => $data['approve']], 'users', ['id' => $data['_id']]);
	}
}//class
