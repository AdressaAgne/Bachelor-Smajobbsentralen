<?php

class blismajobber {

	private $db;
	private $page;

	function __construct($db, $page) {
		$this->db = $db;
		$this->page = $page;
	}

	public function categories(){

		return $this->db->all('kategorier');

	}

	/**
	*	page/blismajobber put request
	*	form validation and insert to db
	*/
	public function put($data){
        
       // die(print_r($data, true));
        
            $validateForm = true;
            foreach($data as $key => $value){
                /*
                if($key == 'car' || $key == 'hitch'){
                    if(preg_match('/{0,1}/', $value)) $validateForm = false;
                } else {
                        if(empty($value)) $validateForm = false;
                }*/
                
                switch($key){
                    case 'firstname' : 
                        if(empty($value)) $validateForm = false;
                        break;
                    case 'lastname' : 
                        if(empty($value)) $validateForm = false;
                        break;
                    case 'email' : 
                        if(empty($value)) $validateForm = false;
                        break;
                    case 'address' : 
                        if(empty($value)) $validateForm = false;
                        break;
                    case 'date' : 
                        if(empty($value)) $validateForm = false;
                        break;
                    case 'mob' : 
                        if(empty($value)) $validateForm = false;
                        break;
                    case 'car' : 
                        if(preg_match('/{0,1}/', $value)) $validateForm = false;
                        break;
                    case 'hitch' : 
                        if(preg_match('/{0,1}/', $value)) $validateForm = false;
                        break;
                    case 'occupation' : 
                        if(empty($value)) $validateForm = false;
                        break;
                    case 'work' : 
                        if(empty($value)) $validateForm = false;
                        break;
                    case 'silence' : 
                        if(empty($value)) $validateForm = false;
                        break;
                    default :
                        continue;
                }
            }

        
        if ($validateForm){
            $id = $this->db->insert('users', [
                [
                    'name'          => $data['firstname'],
                    'surname'       => $data['lastname'],
                    'email'         => $data['email'],
                    'dob'           => $data['date'],
                    'mobile_phone'  => $data['mob'],
                    'private_phone' => $data['priv'],
                    'car'           => $data['car'],
                    'hitch'         => $data['hitch'],
                    'occupation'    => $data['occupation'],
                    'other_info'    => $data['otherinfo'],

                ]
            ]);
            
            $work = [];
            foreach($data['work'] as $value){
                $work[] = [
                    'user_id' => $id,
                    'category_id' => $value,
                ];
            }
        
            $this->db->insert('user_category', $work);
            
            return (View::make('index', ['page' => $this->page, 'class' => $this]));
            
        } else {
            return (View::make('index', ['page' => $this->page, 'class' => $this, 'error' => 'error']));   
        }
	}

}


//Array ( [_method] => PUT [_token] => 58d12c64efed9 [firstname] => Thomas [lastname] => Hesselberg [email] => thomhess@vikenfiber.no [address] => Gullbakkveien 7b [date] => 0231-03-12 [mob] => 90273600 [priv] => [car] => 1 [hitch] => 0 [occupation] => disabled [work] => Array ( [0] => snømåking [1] => flytting [2] => småarbeid ) [otherinfo] => [silence] => on [_submit] => Send inn søknad [param] => page/blismajobber [id] => blismajobber )