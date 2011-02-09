<?php

require_once(realpath(dirname(__FILE__))."/../source/config.php");
require_once(realpath(dirname(__FILE__))."/../source/db_connect.class.php");
require_once(MODEL_PATH."/area.model.php");

class Region extends DB_connect{

    public $region_id;
    public $center_id;
    public $name;
    public $areas;

    public function  __construct($dbo = NULL, $config = NULL, $region_id = 0, $center_id = 0, $name = NULL, $areas = NULL) {
        parent::__construct($dbo, $config);

        $this->region_id = empty($region_id) ? 0 : $region_id;
        $this->center_id = empty($center_id) ? 0 : $center_id;
        $this->name = empty($name) ? NULL : $name;

        $this->areas = is_array($areas) ? $areas : array();
        if($this->region_id)
            $this->getRegionAreas();

    }

    public function add(){

        $query = "INSERT INTO regions (name, center_id) VALUES ('$this->name', '$this->center_id')";

        $sth = $this->db->prepare($query);
        $sth->execute();

        return $this->db->lastInsertId();
    }

    public function update(){
        
        $query = "UPDATE regions SET name='$this->name', center_id='$this->center_id' WHERE region_id=$this->region_id";

        $sth = $this->db->prepare($query);
        return $sth->execute();
    }

    public function remove(){

        $query = "DELETE FROM regions WHERE region_id=$this->region_id";

        $sth = $this->db->prepare($query);
        return $sth->execute();
    }

    public function getRegionAreas(){

        $query = "SELECT area_id, name FROM areas WHERE region_id=$this->region_id";
        $sth = $this->db->query($query);
        $sth->setFetchMode(PDO::FETCH_ASSOC);

        while($row = $sth->fetch())
            $this->areas[] = new Area($this->db, NULL, $row["area_id"], $this->region_id, $row["name"], NULL);

        return true;
    }

    public static function getAllRegions(PDO $dbh){

        if(!is_object($dbh))
            return false;

        $query = "SELECT * FROM regions";
        $sth = $dbh->query($query);
        $sth->setFetchMode(PDO::FETCH_ASSOC);

        $regions = array();
        while($row = $sth->fetch())
            $regions[] = new Region ($dbh, NULL, $row["region_id"], $row["center_id"], $row["name"], NULL);

        return $regions;
    }
}

?>
