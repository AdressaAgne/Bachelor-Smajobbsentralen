<?php
namespace App\Controllers;

use View, Direct, Route, Config, Uploader, Account, Request;


class AdminController extends CalendarController {
    
    public function admin(){
        
        if(Account::isLoggedIn()){
            if($this->user->type == 0 || $this->user->type == 3)
                Direct::re('/telefonvakt');
                
            if($this->user->type == 1)
                Direct::re('/kunder');
                
        } else {
            Direct::re('/login');
        }
        
    }
    
    public function telefonvakt(Request $request){
        $month = isset($request->get->month) ? $request->get->month : date('n', time());
		$year = isset($request->get->year) ? $request->get->year : date('Y', time());

        $next_month = ($month == 12) ? 1 : $month + 1;
		$next_year = ($month == 12) ? $year + 1 : $year;
		
		$prev_month = ($month == 1) ? 12 : $month - 1;
		$prev_year = ($month == 1) ? $year - 1 : $year;
        
        return View::make('telefonvakt', [
            'month' => $month,
            'next_month' => $next_month,
            'prev_month' => $prev_month,
            'year' => $year,
            'next_year' => $next_year,
            'prev_year' => $prev_year,
            'calendar' => $this->calendar($month, $year)]);
    }
    
    public function kunder(){
        return View::make('kunder');
    }
	
	//add to calendar
	public function calendar_put(Request $request){
		
		$this->query('INSERT INTO calendar (unix, user_id, description)
			VALUES(:unix, :id, :description) 
			ON DUPLICATE KEY 
				UPDATE user_id = :id, description = :description', [
			'unix'        => mktime(0, 0, 0, $request->post->month, $request->post->day, $request->post->year),
			'id'          => $request->post->user_id,
			'description' => $request->post->desc,
		]);
		
		Direct::re('/telefonvakt/'.$request->get->month.'/'.$request->get->year);
	}
    
}
