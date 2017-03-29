<?php

class telefonvakt {
    
    public $month = 1;
    public $year = 2017;
    
    public function __construct($db){
        $this->db = $db;
        
        $this->month = date('m', time());
        $this->year = date('Y', time());
    }
    
    public function calendar($month = null, $year = null){
        if(is_null($month)) $month = $this->month;
        if(is_null($year)) $year = $this->year;
        
        $cal = [];
        
        $time = mktime(0, 0, 0, $month, 1, $year);
        $blanks = date('N', $time)-1;
        $total_days = date('t', $time);
        
        $today = date('d', time());
        $m = date('m', time());
        $y = date('Y', time());
        
        $prev_month = ($month == 1) ? 12 : $month-1;
        $prev_year = ($month == 1) ? $year-1 : $year;
        
        $prev_month_days = date('t', mktime(0, 0, 0, $prev_month, 1, $prev_year));
        
        for ($days = 0; $days < $blanks; $days++) { 
            $date = ($prev_month_days - $blanks + $days + 1);
            $cal[] = [
                'class' => 'blank',
                'day' => '',
                'date' => $date,
                'work' => '',  
            ];

        }
        $work = $this->db->select('calendar', ['*'], ['month' => $month, 'year' => $year])->fetchAll();
        $work = $this->db->query('SELECT c.year, c.month, c.day, u.name, u.surname, u.mobile_phone, u.private_phone
                                  FROM calendar as c
                                  LEFT JOIN users AS u ON c.user_id = u.id
                                  WHERE c.month = :m AND c.year = :y',
                                  ['m' => $month, 'y' => $year])->fetchAll();
        
        for($days = 1; $days <= $total_days; $days++) {
		    $date = date('N', mktime(0, 0, 0, $month, $days, $year));
            $user = array_search($days, array_column($work, 'day'));
            $user = $user !== false ? $work[$user] : null;
            
			$cal[] = [
                'date'   => $days,
                'class'  => ($days == $today && $m == $month && $y == $year) ? 'current' : ($date == 7 ? 'holy' : 'normal'),
                'day'    => $this->day_to_str($date),
                'work'   => $user,
            ];
        }
        
        return $cal;
    }
    
    
    public function day_to_str($i){
        return ['Mandag','Tirsdag','Onsdag','Torsdag','Fredag','Lørdag','Søndag'][$i-1];
    }
    public function month_to_str($i){
        return ['Januar', 'Februar', 'Mars', 'April', 'Mai', 'Juni', 'Juli', 'August', 'September', 'Oktober', 'November', 'Desember'][$i-1];
    }
    
    public function post($data){
        $this->month = $data['month'];
        $this->year = $data['year'];

        if(isset($data['next'])){
            if($this->month == 12){
                $this->month = 1;
                $this->year++;
            } else {
                $this->month++;
            }
        }
        
        if(isset($data['prev'])){
            if($this->month == 1){
                $this->month = 12;
                $this->year--;
            } else {
                $this->month--;
            }
        }
        return false;
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