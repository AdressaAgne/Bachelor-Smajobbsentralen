<?php

class frontpage {
    private $db;
    
    function __construct($db) {
        $this->db = $db;
    }
    
    public function categories(){
        return ['snømåking', 'hage', 'måking'];
    }
}
