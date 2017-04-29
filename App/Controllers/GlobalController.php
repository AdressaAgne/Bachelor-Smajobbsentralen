<?php

namespace App\Controllers;

use DateTime;

class GlobalController {
    
    public $open;
    
    public function __construct($db){
        $this->db = $db;
        $this->open = $this->db->all('opningstider'); 
    }
    
    public function categories(){
        return $this->db->all('kategorier');
    }
    
    public function opentimes(){
        return ['isOpen' => $this->isOpen($this->open), 'timeStr' => $this->formatTime($this->open)];
    }
    
    public function get_open_days(){
        return array_column($this->open, 'day');
    }
    
    public function get_open($i){
        return $this->open[array_search($i, array_column($this->open, 'day'))];
    }
    
    public function users(){
        // type = 1, telefonvakt
        return $this->db->select('users', ['*'], ['type' => 1], 'User')->fetchAll();
    }
    
    public function get_age($date){
        $date = explode('-', $date);
        $date = new DateTime(date('Y-m-d', mktime(0, 0, 0, $date[2], $date[1], $date[0])));
        $now = new DateTime(date('Y-m-d', time()));
        return $now->diff($date)->y;
    }
    
    public function formatTime($open){
        $str = [];
        foreach ($open as $key => $value) {
            $str[] = $this->day_to_str($value['day']) . ': ' . $value['from_time'] . ' til ' . $value['to_time'];
        }
        
        return $str;
    }
    
    public function day_to_str($i){
		return ['Mandag','Tirsdag','Onsdag','Torsdag','Fredag','Lørdag','Søndag'][$i-1];
	}
	public function month_to_str($i){
		return ['Januar', 'Februar', 'Mars', 'April', 'Mai', 'Juni', 'Juli', 'August', 'September', 'Oktober', 'November', 'Desember'][$i-1];
	}
    
    public function isOpen($open){
        $now = time();
        $day = date('N', $now);
        $time = date('H:i', $now);
        foreach ($open as $key => $value) {
            if($day == $value['day']){
                if (($time > $value['from_time']) && ($time < $value['to_time'])) return 'Åpent';
            }
        }
        return 'Stengt';
    }
    
    public function format_phonenr($nr){
		$new = preg_replace('/[^[:digit:]]/', '', $nr);

		preg_match('/(\d{3})(\d{2})(\d{3})/', $new, $matches);
		if(count($matches) == 4)
			return "{$matches[1]} {$matches[2]} {$matches[3]}";
		return $nr;
	}
    
}
