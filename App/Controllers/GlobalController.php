<?php

namespace App\Controllers;

use DateTime;

class GlobalController {
    
    public $open;
    public $breadcrubs;
    
    public function __construct($db){
        $this->db = $db;
        $this->open = $this->db->all('opningstider'); 
        
        
        
        $url = explode('/', $_GET['param']);

        $concat = '';
        foreach ($url as $key => $value) {
            $url[$key] = "<li><a href='/$concat$value'>$value</a></li>";
            $concat .= $value.'/';
        }
        
        $this->breadcrubs = '<ul class="breadcrubs">'.implode('<li> / </li>', $url).'</ul>';

        
    }
    
    public function categories(){
        return $this->db->query('SELECT * FROM kategorier ORDER BY id DESC');
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
    
    public function get_age($year){
        $date = new DateTime(date('Y-m-d', mktime(0, 0, 0, 0, 0, $year)));
        $now = new DateTime(date('Y-m-d', time()));
        return $now->diff($date)->y;
    }
    
    public function get_priser(){
        $priser = $this->db->all('settings');
        return array_combine(array_column($priser, 'item_key'), $priser);
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
