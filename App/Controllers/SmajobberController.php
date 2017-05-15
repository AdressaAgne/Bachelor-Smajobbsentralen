<?php

namespace App\Controllers;

use View, NormalController, Config, Direct, Request;

class SmajobberController extends Controller{

	public function smajobbere(Request $data){
		if(isset($data->get->id)) {
			$smajobbere = $this->query("SELECT u.name, u.surname, u.mobile_phone, u.private_phone AS tlf
			FROM users AS u
			INNER JOIN user_category AS uc ON u.id = uc.user_id
			INNER JOIN kategorier AS k ON uc.category_id = k.id
			WHERE uc.category_id = :id AND u.approved = 1 AND u.visible = 1
			GROUP BY u.id
			ORDER BY rand()", [ 'id' => $data->get->id], 'User')->fetchAll();;
		} else {
			$smajobbere = $this->get_smajobbere();
		}	
			
		return View::make('smajobber', ['smajobbere' => $smajobbere]);
	}
	
	public function admin(){
		return View::make('smajobberadmin', ['smajobbere' => $this->get_smajobbere()]);
	}
	
	public function get_smajobbere(){
		return $this->query("SELECT *
			FROM users WHERE visible = 1
			AND approved = 1
			ORDER BY rand()", 'User')->fetchAll();
	}

	public function post($data){

		/*Bugger seg med "NAME" attributt fra kategorier table og users table TODO */
		$smajobbere = $this->query("SELECT u.name, u.surname, u.mobile_phone AS mobil, u.private_phone AS tlf
		FROM users AS u
		INNER JOIN user_category AS uc ON u.id = uc.user_id
		INNER JOIN kategorier AS k ON uc.category_id = k.id
		WHERE uc.category_id = :id AND u.approved = 1 AND u.visible = 1
		GROUP BY u.id
		ORDER BY rand()", [ 'id' => $data['_id']], 'User')->fetchAll();
		//skal virke men får sålangt ingen ID input fra ajax req

		return $smajobbere;


	}//sorting()

	public function application(){
		return View::make('blismajobber');
		
	}

	/**
	*	page/blismajobber put request
	*	form validation and insert to db
	*/
	public function put($data){
            $validateForm = true;
			unset($data['_method']);
			unset($data['_token']);
			
			
			
            foreach($data as $key => $value){
				
                if($key == 'otherinfo') continue;
                if($key == 'work') continue;
                if($key == 'priv') continue;
                
                if($key == 'car' || $key == 'hitch'){
                    if(!preg_match('/[0|1]/', $value)) {
						$validateForm = false;
					}
                } else {
                    if(empty($value)) {
						$validateForm = false;
					}
                }
                
            }
        
        if ($validateForm){
			$username = strtolower(substr($data['firstname'], 0, 3) . substr($data['lastname'], 0, 3) . substr($data['date'], 2, 3));
            $id = $this->insert('users', [
                [
                    'name'          => $data['firstname'],
                    'surname'       => $data['lastname'],
                    'mail'          => $data['email'],
                    'dob'           => $data['date'],
                    'mobile_phone'  => preg_replace('/\\s/us', '', $data['mob']),
                    'private_phone' => preg_replace('/\\s/us', '', $data['priv']),
                    'car'           => $data['car'],
                    'hitch'         => $data['hitch'],
                    'occupation'    => $data['occupation'],
                    'other_info'    => $data['otherinfo'],
                    'address'    	=> $data['address'],
                    'username'    	=> $username,
                ]
            ]);
			
            $work = [];
            foreach($data['work'] as $value){
                $work[] = [
                    'user_id' => $id,
                    'category_id' => $value,
                ];
            }
        
            $this->insert('user_category', $work);
            
            return (View::make('blismajobber', ['class' => $this, 'info' => 'Takk for at du melte deg på']));
            
        } else {
            return (View::make('blismajobber', ['class' => $this, 'error' => 'Noe gikk galt med registreringen']));   
        }
	}
}