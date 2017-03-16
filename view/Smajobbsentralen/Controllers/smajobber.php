<?php 

class smajobber {
    
    private $db;
    
    function __construct($db) {
        $this->db = $db;
    }
    
    public function get_cats(){
        
        return $this->db->all('kategorier');
        
    }
}
