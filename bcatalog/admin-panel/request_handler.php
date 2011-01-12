<?php

require_once("../source/config.php");

$obj     = empty($_GET["obj"]) ? null : $_GET["obj"];
$command = empty($_GET["cmd"]) ? null : $_GET["cmd"];

switch ($obj) {
    case "user": {
        die($config["errors"]["temp"]);
    }
    case "quest" : {
        // operations with questions
        require_once MODEL_PATH.'/question.model.php';
        require_once MODEL_PATH.'/answer.model.php';

        try{
            switch ($command) {
                case "add": {

                    if(empty($_GET["topic_id"]) || empty($_GET["content"]) || empty($_GET["right_answer_id"]))
                        die($config["errors"]["data"]["no-less"]);

                    $quest = new Question(null,
                                          $config,
                                          0,
                                          $_GET["topic_id"],
                                          $_GET["content"],
                                          (empty($_GET["img"]) ? null : $_GET["img"]),
                                          $_GET["right_answer_id"]);

                    $quest_id = $quest->addToDB();
                    echo $quest_id."<br/>";
                    if(!empty($_GET["answers"]) && count($_GET["answers"]) > 0)
                        foreach ($_GET["answers"] as $answer){

                            if(empty($answer))
                                continue;

                            $ansToRec = new Answer($quest->getDBHandler(), $config, 0, $quest_id, $_GET["topic_id"], $answer);
                            $ansToRec->addToDB();
                        }

                    break;
                }
                case "remove": {
                    die($config["errors"]["temp"]);
                }
                case "update": {
                    die($config["errors"]["temp"]);
                }
                default:
                    die($config["errors"]["data"]["no-ness"]);
            }
        }
        catch(PDOException $e){
            // add errors logging into the file
            //DB_connect::printErrorReport($e);
            die("{\"success:\":\"0\", \"error\":\"1\", \"notification\":\"DB error\"}");
        }
    }
    case "answer": {
        die($config["errors"]["temp"]);
    }
    case "ticket": {
        die($config["errors"]["temp"]);
    }
    case "topic": {
        die($config["errors"]["temp"]);
    }
    default:
        die($config["errors"]["data"]["no-ness"]);
}

?>