<?php

class faktura{
    
    public $oppdrag = [];
    
    function __construct($db){
        $this->db = $db;
        
        $this->oppdrag = $this->db->query('SELECT * FROM oppdrag AS o
        JOIN kategorier AS c ON c.id = o.cat_id
        GROUP BY o.id',['user_id' => $_SESSION['uuid']])->fetchAll();
    }
    
    
    public function get_kunder(){
        return $this->db->select('users', ['*'], ['type' => 2], 'User')->fetchAll();    
    }
    
    public function get_oppdrag($id){
        return array_filter($this->oppdrag, function($value) use($id){
            return $value['for_user_id'] == $id;
        });
    }
    
    public function put($data){
        $this->db->insert('oppdrag', [[
            'user_id'         => $_SESSION['uuid'],
            'cat_id'          => $data['cat_id'],
            'tid'            => $data['time'],
            'for_user_id'     => $data['for_user_id'],
            'km'              => $data['km'],
            'hitch'           => isset($data['hitch']),
            'equipment'       => isset($data['equipment']),
            'info'            => $data['info'],
        ]]);
        
        $this->__construct($this->db);
        
        return false;
        
    }
    
    public function patch(){
        
        return ['patch'];
        
    }
    
    public function delete(){
        
        return ['delete'];
        
    }
}