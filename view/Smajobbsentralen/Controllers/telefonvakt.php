<?php

class telefonvakt {
    
    public function __construct($db){
        $this->db = $db;
    }
    
    public function calendar($month = 3, $year = 2017){
        $data = [];
        $cal = [];
        
        $blanks = date('w', mktime(0, 0, 0, $month, 1, $year));
        $total_days = date('t', mktime(0, 0, 0, $month, 1, $year));
        $weekdays = 1;
        $iDay = 0;
        $today = date('d', time());
        
        for ($days = 0; $days < $blanks; $days++) { 
            $cal[] = [
                'class' => 'blank',    
            ];
            $weekdays++;
        }
        
        $work = $this->db->select('calendar', ['*'], ['month' => $month, 'year' => $year])->fetchAll();
        $work = $this->db->query('SELECT c.year, c.month, c.day, u.name, u.surname, u.mobile_phone, u.private_phone
                                  FROM calendar as c
                                  LEFT JOIN users AS u ON c.user_id = u.id
                                  WHERE c.month = :m AND c.year = :y
                                  ',
                                  
                                  ['m' => $month, 'y' => $year])->fetchAll();
        
        for($days = 1; $days <= $total_days; $days++) {
		    $data = date('N', mktime(0, 0, 0, $month, $days, $year));
			/* add in the day number */
            
            $user = array_search($days, array_column($work, 'day'));
            $user = $user !== false ? $work[$user] : null;
            
			$cal[] = [
                'date'   => $days,
                'class'  => $days == $today ? 'current' : ($data == 1 ? 'holy' : 'normal'),
                'day'    => $data,
                'work'   => $user,
            ];
        }
        
        return $cal;
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
    
}