<?php

class applications {

	public function __construct($db){
		$this->db = $db;
	}

    public function get_applications(){

        return $this->db->query('SELECT * from users WHERE approved = 0 ORDER BY time DESC', 'User')->fetchAll();

    }

    public function get_work($id){
        $work = $this->db->query('SELECT c.name FROM user_category AS u
                                 JOIN kategorier AS c ON c.id = u.category_id
                                 WHERE u.user_id = :id',
                                 ['id' => $id])->fetchAll();

        return array_column($work, 'name');
    }

    public function get_age($date){
        $date = explode('-', $date);
        $date = new DateTime(date('Y-m-d', mktime(0, 0, 0, $date[2], $date[1], $date[0])));
        $now = new DateTime(date('Y-m-d', time()));
        return $now->diff($date)->y;

    }

    public function post($data){

        return $this->db->updateWhere('users', ['approved' => 1], ['id' => $data['user_id']]);
    }

	public function patch($data){

		if($this->db->deleteWhere('users', 'id', $data['user_id'])){
			return $this->db->deleteWhere("user_category", "user_id", $data['user_id']);
		}
	}

}
