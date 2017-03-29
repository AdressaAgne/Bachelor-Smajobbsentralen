<?php

class telefonvakt {
    
    public $month = 0;
    public $year = 0;
    
    public function __construct($db){
        $this->db = $db;
    }
    
    public function calendar($month = null, $year = null){
        if(is_null($month)) $month = date('m', time());
        if(is_null($year)) $year = date('Y', time());
        $this->year = $year;
        $this->month = $month;
        $data = [];
        $cal = [];
        
        $blanks = date('w', mktime(0, 0, 0, $month, 1, $year)) -1;
        $total_days = date('t', mktime(0, 0, 0, $month, 1, $year));
        $iDay = 0;
        $today = date('d', time());
        
        for ($days = 0; $days < $blanks; $days++) { 
            $cal[] = [
                'class' => 'blank',
                'day' => '',
                'date' => '',
                'work' => '',  
            ];
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
                'class'  => $days == $today ? 'current' : ($data == 7 ? 'holy' : 'normal'),
                'day'    => $this->ISO_8601($data),
                //'day'    => $data,
                'work'   => $user,
            ];
        }
        
        for ($i = $blanks + $total_days; $i < 35; $i++) { 
            $cal[] = [
                'class' => 'blank',
                'day' => '',
                'date' => '',
                'work' => '',  
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
    
    public function ISO_8601($i){
        switch ($i) {
            case 1:
                return 'Mandag';
            case 2:
                return 'Tirsdag';
            case 3:
                return 'Onsdag';
            case 4:
                return 'Torsdag';
            case 5:
                return 'Fredag';
            case 6:
                return 'Lørdag';
            case 7:
                return 'Søndag';
        }
    }
    public function month_to_str($i){
        switch ($i) {
            case 1:
                return 'Januar';
            case 2:
                return 'Februar';
            case 3:
                return 'Mars';
            case 4:
                return 'April';
            case 5:
                return 'Mai';
            case 6:
                return 'Juni';
            case 7:
                return 'Juli';
            case 8:
                return 'August';
            case 9:
                return 'September';
            case 10:
                return 'Okober';
            case 11:
                return 'November';
            case 12:
                return 'Desember';
        }
    }
    
    public function post($data){
        
        if(isset($data['next'])){
            if($this->month == 12) {
                $this->month = 1;
                $this->year++;
            } else {
                $this->month++;
            }
        }
        if(isset($data['prev'])){
            if($this->month == 1) {
                $this->month = 12;
                $this->year--;
            } else {
                $this->month--;
            }
        }
        
        
    }
}