<?php

require_once (realpath(dirname(__FILE__))."/../source/config.php");
require_once (realpath(dirname(__FILE__))."/../source/db_connect.class.php");

class Department extends DB_connect {

    public $Kod;
    public $Kod_B;
    public $Type;
    public $Name;
    public $Adress;
    public $Work_day;
    public $Work_hour;
    public $Phone;
    public $BYR;
    public $USD;
    public $EUR;
    public $RUR;
    public $Pop_nal;
    public $Comment;
    public $city_id;
    public $map_link;

    public function  __construct($dbo = NULL, $config = NULL, $Kod = 0, $Kod_B = 0, $Type = 0, $Name = NULL, $Adress = NULL, $city_id = NULL, $Work_day = NULL , $Work_hour = NULL, $Phone = NULL, $Comment = NULL, $BYR = 0, $USD = 0, $EUR = 0, $RUR = 0, $Pop_nal = 0, $map_link) {

        parent::__construct($dbo, $config);

        $this->Kod = empty($Kod) ? 0 : $Kod;
        $this->Kod_B = empty($Kod_B) ? 0 : $Kod_B;
        $this->Type = empty($Type) ? 0 : $Type;
        $this->Name = empty($Name) ? NULL : $Name;
        $this->Adress = empty($Adress) ? NULL : $Adress;
        $this->Work_day = empty($Work_day) ? NULL : $Work_day;
        $this->Work_hour = empty($Work_hour) ? NULL : $Work_hour;
        $this->Phone = empty($Phone) ? NULL : $Phone;
        $this->BYR = empty($BYR) ? 0 : $BYR;
        $this->USD = empty($USD) ? 0 : $USD;
        $this->EUR = empty($EUR) ? 0 : $EUR;
        $this->RUR = empty($RUR) ? 0 : $RUR;
        $this->Pop_nal = empty($Pop_nal) ? 0 : $Pop_nal;
        $this->Comment = empty($Comment) ? NULL : $Comment;
        $this->city_id = empty($city_id) ? 0 : $city_id;
        $this->map_link = empty($map_link) ? NULL : $map_link;
    }

    public function getDBH(){
        return $this->db;
    }

    public function add() {

        $query = "INSERT INTO otd (Kod_B, Type, Name, Adress, city_id, Work_day, Work_hour, Phone, Comment, BYR, USD, EUR, RUR, Pop_nal, map_link) VALUES ($this->Kod_B, $this->Type, '$this->Name', '$this->Adress', $this->city_id, '$this->Work_day', '$this->Work_hour', '$this->Phone', '$this->Comment', $this->BYR, $this->USD, $this->EUR, $this->RUR, $this->Pop_nal, '$this->map_link')";

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

        $query = "UPDATE otd SET (";

        foreach($this as $key => $value){
            if($key == 'db' || $key == 'Kod' || !$value)
                continue;

            $query .= $key."='".$value."', ";
        }

        return substr($query, 0, -2).") WHERE Kod=$this->Kod";
    }


    /*
     * удаляет запись с id текущего объекта из БД
     */
    function remove(){

        $query = "REMOVE FROM otd WHERE Kod = $thid->Kod";
        $STH = $this->db->prepare($query);
        $STH->execute();

        return true;
    }


    /*
     * получает название текущего отделения в зависимости от его типа
     */
    function getDepartmentName(){

        switch($this->Type){
            case 1 : return $this->Name;
            case 2 : return "Банкомат";
            case 3 : return "Обменный пункт";
            case 4 : return "Инфокиоск";
            case 5 : return "Платежный терминал";
        }
    }


    /*
     * получает те отделения банка, id которого получил, которые находятся в городе c id=$city_id
     * @param {PDO} $dbh дескриптор БД
     * @param {int} $bank_id id банка
     * @param {int} $city_id id города
     * @param {int} $pageLength id длина требуемой страницы
     * @param {int} $pageNum = 0 номер требуемой страницы
     * @param {array} $types массив типов отделений, которые хотим получить
     */
    public static function getBankDepartments(PDO $dbh, $bank_id, $city_id, $pageLength, $pageNum = 0, $types = null){

        // отступ получаем помощью page*pageNum
        if(empty($city_id) || !is_numeric($city_id) || empty($bank_id) || !is_numeric($bank_id) || empty($pageLength) || !is_numeric($pageLength))
            return false;

        $pageNum = empty($pageNum) ? 1 : $pageNum;
        $startIndex = $pageLength*($pageNum-1);

        if($types)
            $typeCond = Department::generateTypeCondition($types);
        
        $query = "SELECT * FROM otd WHERE (Kod_B=$bank_id AND city_id=$city_id $typeCond) ORDER BY Kod LIMIT $startIndex,$pageLength";
        
        $STH = $dbh->query($query, PDO::FETCH_ASSOC|PDO::FETCH_PROPS_LATE, "Department", array("db"=>$dbh, "config"=>NULL));
        
        $departmentArr = array();
        while ($resultObj = $STH->fetch())
            $departmentArr[] = $resultObj;

        return count($departmentArr) > 0 ? $departmentArr : false;
    }


    /*
     * возвращает количество строк по данной выборке
     * @param {PDO} $dbh дескриптор БД
     * @param {int} $bank_id id банка
     * @param {int} $city_id id города
     */
    public static function countPageNum(PDO $dbh, $bank_id, $city_id, $condition = NULL, $typeCondition = NULL){
        //echo "SELECT COUNT(*) as rows FROM otd WHERE (Kod_B=$bank_id AND city_id=$city_id".(!$condition ? "" : (" AND $condition")).")";

        $rows = $dbh->prepare("SELECT COUNT(*) as rows FROM otd WHERE (Kod_B=$bank_id AND city_id=$city_id".(!$condition ? "" : ("$condition"))." ".(!$typeCondition ? "" : ("$typeCondition")).")");
        $rows->execute();

        return $rows->fetch(PDO::FETCH_OBJ)->rows;
    }


    /*
     * получает массив адресов, которые хотя бы частично совпадают с $adr_part
     * @param {PDO} $dbh дескриптор БД
     * @param {int} $bank_id id банка
     * @param {int} $city_id id города
     * @param {String} $adr_part часть адреса отделения
     */
    public static function getDeptAdress(PDO $dbh, $bank_id, $city_id, $adr_part){

        $rows = $dbh->prepare("SELECT Adress, Type FROM otd WHERE (Kod_B=$bank_id AND city_id=$city_id AND (Adress LIKE'%$adr_part%'))");
        $rows->execute();
        $rows->setFetchMode(PDO::FETCH_ASSOC);

        $result = array("1"=>array(),"2"=>array(),"3"=>array(),"4"=>array(),"5"=>array());
        while($row = $rows->fetch())
            array_push (&$result[$row["Type"]], $row["Adress"]);

        return $result;
    }


    /*
     * получает те отделения банка, id которого получил, которые находятся в городе c id=$city_id
     * и часть адреса которых совпадает с переданной частью адреса $adr_part
     * @param {PDO} $dbh дескриптор БД
     * @param {int} $bank_id id банка
     * @param {int} $city_id id города
     * @param {String} $adr_part часть адреса отделения
     * @param {int} $pageLength id длина требуемой страницы
     * @param {int} $pageNum = 0 номер требуемой страницы
     */
    public static function getBankDepartmentsByAdress(PDO $dbh, $bank_id, $city_id, $adr_part, $pageLength, $pageNum = 0, $types = NULL){

        // отступ получаем помощью page*pageNum
        if(empty($city_id) || !is_numeric($city_id) || empty($bank_id) || !is_numeric($bank_id) || empty($pageLength) || !is_numeric($pageLength))
            return false;

        $pageNum = empty($pageNum) ? 1 : $pageNum;
        $startIndex = $pageLength*($pageNum-1);

        if($types)
            $typeCond = Department::generateTypeCondition($types);
        
        $query = "SELECT * FROM otd WHERE (Kod_B=$bank_id AND city_id=$city_id AND (Adress LIKE '%$adr_part%') $typeCond) ORDER BY Kod LIMIT $startIndex,$pageLength";
        $STH = $dbh->prepare($query);
        $STH->execute();
        $STH->setFetchMode(PDO::FETCH_ASSOC|PDO::FETCH_PROPS_LATE, "Department", array("db"=>$dbh, "config"=>NULL));

        $departmentArr = array();
        while ($resultObj = $STH->fetch())
            $departmentArr[] = $resultObj;

        return count($departmentArr) > 0 ? $departmentArr : false;
    }

    public static function generateTypeCondition($types){
        if(!$types || count($types) == 0 || (count($types) == 1 && $types[0] == '0'))
            return "";

        $condition = "AND (";
        foreach($types as $value){
            if(!is_numeric($value))
                continue;
            $condition .= (" Type='$value' OR");
        }
        
        return substr($condition, 0, -3)." )";
    }
}

?>