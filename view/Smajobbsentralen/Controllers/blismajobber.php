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
        echo "<pre>";
        die(print_r($data));
        echo "</pre>";
        
            $validateForm = true;
            foreach($data as $key => $value){
                
                if($key == 'otherinfo') continue;
                
                if($key == 'car' || $key == 'hitch'){
                    if(preg_match('/[0|1]/', $value)) $validateForm = false;
                } else {
                    if(empty($value)) $validateForm = false;
                    
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