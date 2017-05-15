<?php

namespace App\Controllers;

use View, NormalController, Config, Direct;

class CalendarController extends Controller {

	public $month = 1;
	public $year = 2017;

	public function __construct(){
		parent::__construct();
		$this->month = date('n', time());
		$this->year = date('Y', time());

	}

	/**
	 * Return true / false if the day input is a holy day, should probably just return the array.
	 * @param  [int]  $day   [the day you wanna check is a holy day]
	 * @param  [int]  $month [the month you wanna check]
	 * @return boolean
	 */
	public function isHoly($day, $month){
		$holy = [
			1 => [
				1 => 'Første nyttårsdag',
			],
			2 => [],
			3 => [],
			4 => [],
			5 => [
				1 => 'Arbeiderens dag',
				17 => 'Norges nasjonaldag',
			],
			6 => [],
			7 => [],
			8 => [],
			9 => [],
			10 => [],
			11 => [],
			12 => [
				24 => 'Julaften',
				25 => 'Først juledag',
				26 => 'Andre juledag',
			],
		];
		//easter_days() returns days after march 21, wich is 80, but on a leap year its 81.
		$easter_days    = easter_days($this->year) + 80 + date('L', mktime(0, 0, 0, 1, 1, $this->year));

        //5 = Fredag
		$lang           = $this->days_to_date($this->get_day_before(5, $easter_days));
        //4 = Torsdag
		$skjer          = $this->days_to_date($this->get_day_before(4, $easter_days));

		$easter_aften   = $this->days_to_date($easter_days - 1);
		$easter_1       = $this->days_to_date($easter_days);
		$easter_2       = $this->days_to_date($easter_days + 1);
		$skyfart        = $this->days_to_date($easter_days + 39);
		$pins_1         = $this->days_to_date($easter_days + 49);
		$pins_2         = $this->days_to_date($easter_days + 50);

		$holy[$lang['month']][$lang['day']] = 'Langfredag';
		$holy[$skjer['month']][$skjer['day']] = 'Skjærtorsdag';

		$holy[$easter_aften['month']][$easter_aften['day']] = 'Påskeaften';
		$holy[$easter_1['month']][$easter_1['day']] = 'Første påskedag';
		$holy[$easter_2['month']][$easter_2['day']] = 'Andre påskedag';

		$holy[$skyfart['month']][$skyfart['day']] = 'Kristi himmelfartsdag';
		$holy[$pins_1['month']][$pins_1['day']] = 'Første pinsedag';
		$holy[$pins_2['month']][$pins_2['day']] = 'Andre pinsedag';

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
		$this->year = $year;
		$this->month = $month;

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

		$work = $this->query('SELECT c.unix, MONTH(FROM_UNIXTIME(c.unix)) as month, YEAR(FROM_UNIXTIME(c.unix)) as year, day(FROM_UNIXTIME(c.unix)) as day, u.name, u.surname, u.mobile_phone, u.private_phone, u.id, c.description
								  FROM calendar as c
								  LEFT JOIN users AS u ON c.user_id = u.id
								  WHERE MONTH(FROM_UNIXTIME(c.unix)) = :m AND YEAR(FROM_UNIXTIME(c.unix)) = :y',
								  ['m' => $month, 'y' => $year])->fetchAll();

		for($days = 1; $days <= $total_days; $days++) {
			$date = date('N', mktime(0, 0, 0, $month, $days, $year));
			$user = array_search($days, array_column($work, 'day'));
			$user = $user !== false ? $work[$user] : null;

			$holy = $this->isHoly($days, $month);

			$cal[] = [
				'date'   => $days,
				'class'  => ($days == $today && $m == $month && $y == $year) ? 'current' : ($date == 7 ? 'holy' : ($holy) ? 'holy' : 'normal'),
				'day'    => $this->global->day_to_str($date),
				'work'   => $user,
				'holy'   => ucfirst($holy),
			];
		}

		return $cal;
	}

}
