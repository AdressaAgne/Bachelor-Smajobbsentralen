<?php

class telefonvakt {

	public $month = 1;
	public $year = 2017;

	public function __construct($db){
		$this->db = $db;

		$this->month = date('n', time());
		$this->year = date('Y', time());

	}

	public function isHoly($day, $month){
		$holy = [
			1 => [
				1 => 'første nyttårsdag',
			],
			2 => [],
			3 => [],
			4 => [],
			5 => [
				1 => 'arbeiderens dag',
				17 => 'norges nasjonaldag',
			],
			6 => [],
			7 => [],
			8 => [],
			9 => [],
			10 => [],
			11 => [],
			12 => [
				24 => 'julaften',
				25 => 'først juledag',
				26 => 'andre juledag',
			],
		];
		//easter_days() returns days after march 21, wich is 80, but on a leap year its 81.
		$easter_days    = easter_days($this->year) + 80 + date('L', mktime(0, 0, 0, 1, 1, $this->year));

		//5 = Fredag


		//4 = Torsdag

		$lang           = $this->days_to_date($this->get_day_before(4, $easter_days));
		$skjer          = $this->days_to_date($this->get_day_before(5, $easter_days));

		$easter_aften   = $this->days_to_date($easter_days - 1);
		$easter_1       = $this->days_to_date($easter_days);
		$easter_2       = $this->days_to_date($easter_days + 1);
		$skyfart        = $this->days_to_date($easter_days + 39);
		$pins_1         = $this->days_to_date($easter_days + 49);
		$pins_2         = $this->days_to_date($easter_days + 50);

		$holy[$lang['month']][$lang['day']] = 'langfredag';
		$holy[$skjer['month']][$skjer['day']] = 'skjærtorsdag';


		$holy[$easter_aften['month']][$easter_aften['day']] = 'påskeaften';
		$holy[$easter_1['month']][$easter_1['day']] = 'første påskedag';
		$holy[$easter_2['month']][$easter_2['day']] = 'andre påskedag';

		$holy[$skyfart['month']][$skyfart['day']] = 'Kristi himmelfartsdag';
		$holy[$pins_1['month']][$pins_1['day']] = '	første pinsedag';
		$holy[$pins_2['month']][$pins_2['day']] = 'andre pinsedag';

		//die(print_r($holy, true));

		return (array_key_exists($day, $holy[$month])) ? $holy[$month][$day] : false;

	}

	public function get_day_before($day, $day_of_year){
		$weekday = date('N', mktime( 0, 0, 0, 1, $day_of_year, $this->year));
		return $day_of_year - $weekday + $day;
		
	}

	public function days_to_date($days){

		$day = date('d', mktime( 0, 0, 0, 1, $days, $this->year));
		$month = date('n', mktime( 0, 0, 0, 1, $days, $this->year));

		return ['day' => $day, 'month' => $month];
	}

	public function calendar($month = null, $year = null){
		if(is_null($month)) $month = $this->month;
		if(is_null($year)) $year = $this->year;

		$cal = [];

		$time = mktime(0, 0, 0, $month, 1, $year);
		$blanks = date('N', $time)-1;
		$total_days = date('t', $time);

		$today = date('d', time());
		$m = date('n', time());
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

			$holy = $this->isHoly($days, $month);

			$cal[] = [
				'date'   => $days,
				'class'  => ($days == $today && $m == $month && $y == $year) ? 'current' : ($date == 7 ? 'holy' : ($holy) ? 'holy' : 'normal'),
				'day'    => $this->day_to_str($date),
				'work'   => $user,
				'holy'   => ucfirst($holy),
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
