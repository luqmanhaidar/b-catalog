<?php

class DB_connect {

    protected $db;

    public function  __construct($dbo = NULL, $config = NULL) {

        if(is_object($dbo))
            $this->db = $dbo;
        else{
            $dsn = "mysql:host=".$config["db"]["hostname"].";dbname=".$config["db"]["dbname"].";charset=UTF-8";

            $this->db = new PDO($dsn, $config["db"]["username"], $config["db"]["password"]);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db->exec('SET CHARACTER SET utf8');
        }
    }

    public function getDBH(){
        return $this->db;
    }
}

?>
