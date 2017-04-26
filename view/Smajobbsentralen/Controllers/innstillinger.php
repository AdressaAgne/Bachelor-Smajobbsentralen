<?php


class innstillinger{

    public $open;
    public $db;

    public function __construct($db){
        $this->db = $db;
        $this->open = $db->all("opningstider");
    }

    public function get_open_days(){
        return array_column($this->open, 'day');
    }
    
    public function get_open($i){
        return $this->open[array_search($i, array_column($this->open, 'day'))];
    }

    public function getArbeidstyper(){
        //return $this->db->all("kategorier", [])->fetchAll();
        return $this->db->query("SELECT name, id FROM kategorier")->fetchAll();
    }

    public function fjernArbeidstype($data){
        return $this->db->deleteWhere('kategorier', 'id', $data['_id']);
    }

    public function addArbeidstype($data){
        return $this->db->insert('kategorier',[
            [
                'name' => $data['_name'],
                'icon' => isset($data['icon']) ? $data['icon'] : "user"
            ]
        ]);
    }
}//class
