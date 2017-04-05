<?php

class GlobalController {
    private $db;
    
    function __construct($db) {
        //param 1, The database
        $this->db = $db;
    }
    
    public function categories(){

        return $this->db->all('kategorier');

    }
    
    public function opentimes(){
        $open = $this->db->all('opningstider'); 
        return ['isOpen' => $this->isOpen($open), 'timeStr' => $this->formatTime($open)];
    }
    
    public function formatTime($open){
        $str = [];
        foreach ($open as $key => $value) {
            $str[] = $this->ISO_8601($value['day']) . ': ' . $value['from_time'] . ' til ' . $value['to_time'];
        }
        
        return $str;
    }
    
    public function day_to_str($i){
		return ['Mandag','Tirsdag','Onsdag','Torsdag','Fredag','Lørdag','Søndag'][$i-1];
	}
	public function month_to_str($i){
		return ['Januar', 'Februar', 'Mars', 'April', 'Mai', 'Juni', 'Juli', 'August', 'September', 'Oktober', 'November', 'Desember'][$i-1];
	}
    
    public function ISO_8601($i){
        switch ($i) {
            case 0:
                return 'Søndag';
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
        }
    }
    
    // 'day' => 4, // torsdag
    // 'from_time' => '10:00',
    // 'to_time' => '12:00',
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
    
}
