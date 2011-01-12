<?php

class DriveTestException extends Exception {

    public static function printErrorReport(){
        printf("<h1>Error:</h1>%s<br/>in: %s at: %d line<br/>", $this->getMessage(), $this->getFile(), $this->getLine());
        print("<pre>");
        print_r($this->getTrace());
        print("</pre>");
    }

    public static function logErrorReport(){

        $log = fopen(LOG_PATH."/db-err.log", "a");
        $report = "-----\n".
                  "ERROR:\n".
                  $this->getMessage()."\n".
                  "in: ".$this->getFile()." at: ".$this->getLine()."\n".
                  "trace: ".$this->getTraceAsString()."\n".
                  "-----\n\n";

        fwrite($log, $report);
        fclose($log);
    }
}

?>
