<?php

class kunder {
    
    function __construct($db, $page){
        $this->db = $db;
    }
    
    
    public function put($data){
        
        $id = $this->db->insert('users', [
            [
                'name'            => $data['name'],    
                'approved'        => 1,    
                'visible'         => 0,    
                'type'            => 2,
                'mobile_phone'    => $data['mobile'],    
                'private_phone'   => $data['private'],    
                'other_info'      => $data['info'],    
                'address'         => $data['address'],    
            ]
        ]);
        
        return Direct::re('/page/faktura');
    }
    
}