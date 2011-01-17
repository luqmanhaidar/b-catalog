<?php

require_once (realpath(dirname(__FILE__))."/../source/config.php");
require_once (realpath(dirname(__FILE__))."/../source/db_connect.class.php");

class Bank extends DB_connect {

    public $Kod_B;
    public $Name_short;
    public $Name_full;
    public $Name_eng;
    public $Www;
    public $Http;
    public $Logo_min;
    public $Logo;
    public $Our_http;
    public $Adress;
    public $Licence;
    public $Owners;
    public $Note;
    public $City;

    public function  __construct($bdo = NULL, $config = NULL, $Kod_B = 0, $Name_short = NULL, $Name_full = NULL, $Name_eng = NULL, $Www = NULL, $Http = NULL, $Logo_min = NULL, $Logo = NULL, $Our_http = NULL, $Adress = NULL, $Licence = NULL, $Owners = NULL, $Note = NULL, $City = NULL) {

        parent::__construct($dbo, $config);

        $this->Kod_B      = empty ($Kod_B) ? 0 : $Kod_B;
        $this->Name_short = empty ($Name_short) ? NULL : $Name_short;
        $this->Name_full  = empty ($Name_full) ? NULL : $Name_full;
        $this->Name_eng   = empty ($Name_eng) ? NULL : $Name_eng;
        $this->Www        = empty ($Www) ? NULL : $Www;
        $this->Http       = empty ($Http) ? NULL : $Http;
        $this->Logo_min   = empty ($Logo_min) ? NULL : $Logo_min;
        $this->Logo       = empty ($Logo) ? NULL : $Logo;
        $this->Our_http   = empty ($Our_http) ? NULL : $Our_http;
        $this->Adress     = empty ($Adress) ? NULL : $Adress;
        $this->Licence    = empty ($Licence) ? NULL : $Licence;
        $this->Owners     = empty ($Owners) ? NULL : $Owners;
        $this->Note       = empty ($Note) ? NULL : $Note;
        $this->City       = empty ($City) ? NULL : $City;
    }

    public function getDBH(){
        return $this->db;
    }

    public function add() {

        $query = "INSERT INTO banks (Name_short, Name_full, Name_eng, Www, Http, Logo_min, Logo, Our_http, Adress, Licence, Owners, Note, City) VALUES ('$this->Name_short', '$this->Name_full', '$this->Name_eng', '$this->Www', '$this->Http', '$this->Logo_min', '$this->Logo', '$this->Our_http', '$this->Adress', '$this->Licence', '$this->Owners', '$this->Note', '$this->City')";

        $STH = $this->db->prepare($query);
        $STH->execute();

        return $this->db->lastInsertId();
    }

    /*
     * обновляет установленные поля объекта в БД у записи с соответствующим id
     * поля, знячения которых не заданы (NULL) обновлены не будут
     */
    public function update(){

        $query = $this->createUdateQuery();
        $STH = $this->db->prepare($query);
        $STH->execute();

        return true;
    }


    /*
     * создает запрос на обновление установленных значений
     */
    private function createUdateQuery(){

        $query = "UPDATE banks SET (";

        foreach($this as $key => $value){
            if($key == 'db' || $key == 'Kod_b' || !$value)
                continue;

            $query .= $key."='".$value."', ";
        }

        return substr($query, 0, -2).") WHERE Kod_b=$this->Kod_b";
    }


    /*
     * получает
     *  - id
     *  - короткое название
     *  - URL сайтa
     *  - URL мини логотипа
     * всех банков из базы и возвращает массив из них
     */
    public static function getBanksShortInfo($dbh){

        $banks = array();
        $query = "SELECT Kod_B,Name_short,Http,Logo_min FROM banks";
        $STH = $dbh->query($query);
        $STH->setFetchMode(PDO::FETCH_CLASS, "Bank", array("db"=>$dbh, "config"=>NULL));

        while($bank = $STH->fetch()){
            $bank->Name_short = str_replace("</b>", "", str_replace("<b>", "", $bank->Name_short));
            $banks[] = $bank;
        }
        return $banks;
    }
}

?>
