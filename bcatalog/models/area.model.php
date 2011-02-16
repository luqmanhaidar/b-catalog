<?php

require_once(realpath(dirname(__FILE__))."/../source/config.php");
require_once(realpath(dirname(__FILE__))."/../source/db_connect.class.php");
require_once(MODEL_PATH."/city.model.php");

class Area extends DB_connect{

    public $region_id;
    public $area_id;
    public $name;
    public $cities;


    public function  __construct($dbo = NULL, $config = NULL, $area_id = 0 , $region_id = 0, $name = NULL, $cities = NULL) {
        parent::__construct($dbo, $config);

        $this->area_id = empty ($area_id) ? 0 : $area_id;
        $this->region_id = empty ($region_id) ? 0 : $region_id;
        $this->name = empty ($name) ? NULL : $name;

        $this->cities = is_array($cities) ? $cities : array();
        if($this->area_id)
            $this->getAreaCities();
    }

    public function add(){

        $query = "INSERT INTO areas (region_id, name) VALUES ('$this->region_id', '$this->name')";

        $sth = $this->db->prepare($query);
        $sth->execute();

        return $this->db->lastInsertId();
    }

    public function update(){

        $query = "UPDATE areas SET region_id=$this->region_id, name='$this->name' WHERE area_id=$this->area_id";

        $sth = $this->db->prepare($query);
        return $sth->execute();
    }

    public function remove(){

        $query = "DELETE FROM areas,cities USING areas,cities WHERE (areas.area_id=$this->area_id AND cities.area_id = areas.area_id)";

        $sth = $this->db->prepare($query);
        if($sth->execute() && $sth->rowCount() > 0)
            return true;
        else{
            $sth = $this->db->prepare("DELETE FROM areas WHERE (area_id=$this->area_id)");
            return $sth->execute();
        }
    }

    public function getAreaCities(){

        $query = "SELECT city_id, name FROM cities WHERE area_id=$this->area_id";
        $sth = $this->db->query($query);
        $sth->setFetchMode(PDO::FETCH_ASSOC);

        while($row = $sth->fetch())
            $this->cities[] = new City($this->db, NULL, $row["city_id"], $this->area_id, $row["name"]);

        return true;
    }
}

?>
