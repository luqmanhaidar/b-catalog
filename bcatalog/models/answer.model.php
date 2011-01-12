<?php

require_once (realpath(dirname(__FILE__))."/../source/config.php");
require_once (realpath(dirname(__FILE__))."/../source/db_connect.class.php");

class Answer extends DB_connect {

    public $answer_id;
    public $quest_id;
    public $topic_id;
    public $content;

    public function  __construct($bdo = NULL, $config = NULL, $answer_id = 0, $quest_id = 0, $topic_id = NULL, $content = NULL) {

        parent::__construct($dbo, $config);

        $this->answer_id = empty ($answer_id) ? 0 : $answer_id;
        $this->quest_id  = empty ($quest_id) ? 0 : $quest_id;
        $this->topic_id  = empty ($topic_id) ? NULL : $topic_id;
        $this->content   = empty ($content) ? NULL : $content;
    }

    public function addToDB() {

        $query = "SELECT answer_id FROM answers WHERE (quest_id=$this->quest_id AND topic_id='$this->topic_id') ORDER BY answer_id DESC LIMIT 1";

        $STH = $this->db->query($query);
        $STH->setFetchMode(PDO::FETCH_ASSOC);

        if($STH->rowCount() > 0){
            $result = $STH->fetch();
            $this->answer_id = ++$result["answer_id"];
        }
        else if ($STH->rowCount() == 0) {
            $this->answer_id = 1;
        }

        $query = "INSERT INTO answers (answer_id, topic_id, quest_id, content) VALUES ($this->answer_id, '$this->topic_id', $this->quest_id, '$this->content')";

        $STH = $this->db->prepare($query);
        $STH->execute();

        return $this->answer_id;
    }

    public function updateContent(){

        $query = "UPDATE answers SET content='$this->content' WHERE answer_id=$this->answer_id";

        $STH = $this->db->prepare($query);
        $STH->execute();

        return true;
    }

    public function updateQuestId(){

        $query = "UPDATE answers SET quest_id='$this->quest_id' WHERE quest_id=$this->answer_id";

        $STH = $this->db->prepare($query);
        $STH->execute();

        return true;
    }
}

?>
