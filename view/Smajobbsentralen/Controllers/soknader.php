<?
class soknader{

    public function __construct($db){
        $this->db = $db;
    }

    	public function get_soknader(){
    		return $this->db->query("SELECT *
    			FROM users WHERE visible = 1
    			AND approved = 0
    			AND id > 0
    			ORDER BY name ASC")->fetchAll();
    	}

    	public function format_phonenr($nr){
    		$new = preg_replace('/[^[:digit:]]/', '', $nr);

    		preg_match('/(\d{3})(\d{2})(\d{3})/', $new, $matches);

    		return "{$matches[1]} {$matches[2]} {$matches[3]}";
    	}

    }//class
