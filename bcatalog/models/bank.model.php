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
    public $city_id;

    public $services_tab;
    public $deposits_tab;
    public $credits_tab;

    public function  __construct($dbo = NULL, $config = NULL, $Kod_B = 0, $Name_short = NULL, $Name_full = NULL, $Name_eng = NULL, $Www = NULL, $Http = NULL, $Logo_min = NULL, $Logo = NULL, $Our_http = NULL, $Adress = NULL, $Licence = NULL, $Owners = NULL, $Note = NULL, $city_id = NULL, $services_tab = 0, $deposits_tab = 0, $credits_tab = 0) {

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
        $this->city_id    = empty ($city_id) ? NULL : $city_id;

        $this->services_tab = $services_tab ? 1 : 0;
        $this->deposits_tab = $deposits_tab ? 1 : 0;
        $this->credits_tab = $credits_tab ? 1 : 0;
    }

    public function getDBH(){
        return $this->db;
    }

    public function add() {

        $query = "INSERT INTO banks (Name_short, Name_full, Name_eng, Www, Http, Logo_min, Logo, Our_http, Adress, Licence, Owners, Note, city_id, services_tab, deposits_tab, credits_tab) VALUES ('$this->Name_short', '$this->Name_full', '$this->Name_eng', '$this->Www', '$this->Http', '$this->Logo_min', '$this->Logo', '$this->Our_http', '$this->Adress', '$this->Licence', '$this->Owners', '$this->Note', '$this->city_id', '$this->services_tab', '$this->deposits_tab', '$this->credits_tab')";

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

        return $STH->execute();
    }


    public function remove(){

        $query = "DELETE FROM banks WHERE Kod_B='$this->Kod_B'";
        $STH = $this->db->prepare($query);

        return $STH->execute();
    }


    /*
     * создает запрос на обновление установленных значений
     */
    private function createUdateQuery(){

        $query = "UPDATE banks SET ";

        foreach($this as $key => $value){
            if($key == 'db' || $key == 'Kod_B')
                continue;

            $query .= $key."='".$value."', ";
        }

        return substr($query, 0, -2)." WHERE Kod_B=$this->Kod_B";
    }


    /*
     * получает и устанавливает значения всех свойств по id
     */
    public function getDataById(){

        $query = "SELECT * FROM banks WHERE Kod_B=$this->Kod_B LIMIT 1";

        $sth = $this->db->query($query);
        $sth->setFetchMode(PDO::FETCH_OBJ|PDO::FETCH_PROPS_LATE, "Bank", array("db" => $this->db, "config" => NULL));

        if($obj = $sth->fetch()){
            
            $this->extend($obj);
            return true;
        }

        return false;
    }

    /*
     * устанавливает все свойства объекта от которого вызван,
     * значениями одноименных свойств объекта $donorObj
     * @param {Bank} $donorObj объект-донор
     */
    public function extend($donorObj){

        //$this->Kod_B
        $this->Name_short   = $donorObj->Name_short;
        $this->Name_full    = $donorObj->Name_full;
        $this->Name_eng     = $donorObj->Name_eng;
        $this->Www          = $donorObj->Www;
        $this->Http         = $donorObj->Http;
        $this->Logo_min     = $donorObj->Logo_min;
        $this->Logo         = $donorObj->Logo;
        $this->Our_http     = $donorObj->Our_http;
        $this->Adress       = $donorObj->Adress;
        $this->Licence      = $donorObj->Licence;
        $this->Owners       = $donorObj->Owners;
        $this->Note         = $donorObj->Note;
        $this->city_id      = $donorObj->city_id;
        $this->services_tab = $donorObj->services_tab;
        $this->credits_tab  = $donorObj->credits_tab;
        $this->deposits_tab = $donorObj->deposits_tab;

        return true;
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
        $STH->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "Bank", array("db"=>$dbh, "config"=>NULL));

        while($bank = $STH->fetch()){
            //print_r($bank);
            $bank->Name_short = str_replace("</b>", "", str_replace("<b>", "", $bank->Name_short));
            $banks[] = $bank;
        }
        return $banks;
    }


    /*
     * получает id банков, хотя бы одно отделение которых находиться в заданном городе
     * @param {PDO} $dbh дескриптор БД
     * @param {String} $city_id название города
     */
    public static function getCitySortBanks(PDO $dbh, $city_id){

        if(empty($city_id) || !is_numeric($city_id))
            return false;

        $query = "SELECT Kod_B FROM otd WHERE city_id=$city_id";
        $STH = $dbh->query($query, PDO::FETCH_ASSOC);

        $idArr = array();
        while ($resultRow = $STH->fetch())
            $idArr[] = $resultRow["Kod_B"];
            
        $result = array();
        foreach (array_unique($idArr) as $key => $value)
            $result[] = $value;

        return count($result) == 0 ? false : $result;
    }
}

?>
