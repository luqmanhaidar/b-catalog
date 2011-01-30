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

//    public static function getAreaCities(PDO $dbh, int $area_id){
//
//        if(empty($area_id) || !is_object($dbh))
//            return false;
//
//        $query = "SELECT city_id, name FROM cities WHERE area_id=$area_id";
//        $sth = $dbh->query($query);
//        $sth->setFetchMode(PDO::FETCH_ASSOC);
//
//
//        $cities = array();
//        while($row = $sth->fetch())
//            $cities[] = new City($dbh, NULL, $row["city_id"], $area_id, $city["name"]);
//
//        return $cities;
//    }

    public function add(){

        $query = "INSERT INTO cities (area_id, name) VALUES ($this->area_id, '$this->name')";

        $this->db->prepare($query);
        $this->db->execute();

        return $this->db->lastInsertId();
    }

    public function update(){

        $query = "UPDATE cities SET (area_id=$this->area_id, name='$this->name') WHERE city_id=$this->city_id";

        $this->db->prepare($query);
        $this->db->execute();

        return true;
    }

    public function remove(){

        $query = "DELETE FROM cities WHERE city_id=$this->city_id";

        $this->db->prepare($query);
        $this->db->execute();

        return true;
    }


}

?>