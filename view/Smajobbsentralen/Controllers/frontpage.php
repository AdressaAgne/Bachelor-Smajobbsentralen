<?php

class frontpage {
    private $db;
    private $page;
    
    function __construct($db, $page) {
        //param 1, The database
        $this->db = $db;
        
        //param 2, the page
        $this->page = $page;
    }
    
    public function categories(){
        return $this->db->all('kategorier');
    }
}
