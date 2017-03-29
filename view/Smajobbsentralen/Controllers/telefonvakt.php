<?php

class telefonvakt {
    
    public function __construct($db){
        $this->db = $db;
        $month = 3;
        $year = 2017;
        
        $data = [];
        $cal = [];
        
        $blanks = date('w', mktime(0, 0, 0, $month, 1, $year));
        $total_days = date('t', mktime(0, 0, 0, $month, 1, $year));
        $weekdays = 1;
        $iDay = 0;
        
        for ($days = 0; $days < $blanks; $days++) { 
            $cal[] = [
                'class' => 'blank',    
            ];
            $weekdays++;
        }

        $work = $this->db->select('calendar', ['*'], ['month' => $month, 'year' => $year])->fetchAll();
        
        for($days = 1; $days <= $total_days; $days++) {
		    $data = date('N', mktime(0, 0, 0, $month, $days, $year));
			/* add in the day number */
			$cal[] = [
                'date'   => $days,
                'class'  => $data == 1 ? 'holy' : 'normal',
                'day'    => $data,
                'work'   => 1,
            ];

			/** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
        }
        
        die(print_r(['data' => [$blanks, $total_days], 'cal' => $cal], true));
    }
    
    public function calendar(){
        $calendar = [];
        die(print_r([$test], true));
        return [
            [
                'date' => 0,
                'class' => 'holy, blank, normal, current',
            ],
        ];
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