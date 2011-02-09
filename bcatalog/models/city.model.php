<?php

require_once(realpath(dirname(__FILE__))."/../source/config.php");
require_once(realpath(dirname(__FILE__))."/../source/db_connect.class.php");

class City extends DB_connect{

    public $city_id;
    public $name;
    public $area_id;

    public function __construct($dbo = NULL, $config = NULL, $city_id = 0, $area_id = 0, $name = NULL) {
        parent::__construct($dbo, $config);

        $this->city_id = empty ($city_id) ? 0 : $city_id;
        $this->area_id = empty ($area_id) ? 0 : $area_id;
        $this->name = empty ($name) ? NULL : $name;

    }
    

    public function add(){

        $query = "INSERT INTO cities (area_id, name) VALUES ($this->area_id, '$this->name')";

        $sth = $this->db->prepare($query);
        $sth->execute();

        return $this->db->lastInsertId();
    }

    public function update(){

        $query = "UPDATE cities SET area_id=$this->area_id, name='$this->name' WHERE city_id=$this->city_id";

        $sth = $this->db->prepare($query);
        return $sth->execute();
    }
    

    public function remove(){

        $query = "DELETE FROM cities WHERE city_id=$this->city_id";

        $sth = $this->db->prepare($query);
        return $sth->execute();
    }


    public function getNameById(){

        $query = "SELECT name FROM cities WHERE city_id=$this->city_id";

        $sth = $this->db->query($query);
        $sth->setFetchMode(PDO::FETCH_ASSOC);

        if($row = $sth->fetch()){
            $this->name = $row["name"];
            return $row["name"];
        }

        return false;
    }
}

?>
