<?php

class DB_connect {

    protected $db;

    protected function  __construct($dbo = NULL, $config = NULL) {

        if(is_object($dbo))
            $this->db = $dbo;
        else{
            $dsn = "mysql:host=".$config["db"]["hostname"].";dbname=".$config["db"]["dbname"].";charset=UTF-8";

            try{
                $this->db = new PDO($dsn, $config["db"]["username"], $config["db"]["password"]);
                $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->db->exec('SET CHARACTER SET utf8');
            }
            catch (Exception $e){
                die($e->getMessage());
            }
        }
    }

    public static function printErrorReport(Exception $exp){
        printf("<h1>Error:</h1>%s<br/>in: %s at: %d line<br/>", $exp->getMessage(), $exp->getFile(), $exp->getLine());
        print("<pre>");
        print_r($exp->getTrace());
        print("</pre>");
    }

    public static function logErrorReport(Exception $exp){

        $log = fopen(LOG_PATH."/db-err.log", "a");
        $report = "-----\n".
                  "ERROR:\n".
                  $exp->getMessage()."\n".
                  "in: ".$exp->getFile()." at: ".$exp->getLine()."\n".
                  "trace: ".$exp->getTraceAsString()."\n".
                  "-----\n\n";

        fwrite($log, $report);
        fclose($log);
    }
}

?>
