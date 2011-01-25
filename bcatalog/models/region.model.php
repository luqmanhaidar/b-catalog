<?php

require_once(realpath(dirname(__FILE__))."/../source/config.php");
require_once(realpath(dirname(__FILE__))."/../source/db_connect.class.php");
require_once(MODEL_PATH."/area.model.php");

class Region extends DB_connect{

    public $region_id;
    public $name;
    public $areas;

    public function  __construct($dbo = NULL, $config = NULL, $region_id = 0, $name = NULL, $areas = NULL) {
        parent::__construct($dbo, $config);

        $this->region_id = empty($region_id) ? 0 : $region_id;
        $this->name = empty($name) ? NULL : $name;

        $this->areas = is_array($areas) ? $areas : array();
    }

    public function add(){

        $query = "INSERT INTO regions (name) VALUES ('$this->name')";

        $this->db->prepare($query);
        $this->db->execute();

        return $this->db->lastInsertId();
    }

    public function update(){

        $query = "UPDATE regions SET (name='$this->name') WHERE region_id=$this->region_id";

        $this->db->prepare($query);
        $this->db->execute();

        return true;
    }

    public function remove(){

        $query = "DELETE FROM regions WHERE region_id=$this->region_id";

        $this->db->prepare($query);
        $this->db->execute();

        return true;
    }

    public function getRegionAreas(){

        $query = "SELECT aera_id, name FROM areas WHERE region_id=$this->region_id";
        $sth = $this->db->query($query);
        $sth->setFetchMode(PDO::FETCH_ASSOC);

        while($row = $sth->fetch())
            $this->aeras[] = new Area($dbh, NULL, $row["area_id"], $this->region_id, $row["name"], NULL);

        return true;
    }
}

?>
