<?php

require_once (realpath(dirname(__FILE__))."/../source/config.php");
require_once (realpath(dirname(__FILE__))."/../source/db_connect.class.php");

class Question extends DB_connect {

    public $quest_id;
    public $topic_id;
    public $content;
    public $img;
    public $right_answer_id;


    public function  __construct($bdo = NULL, $config = NULL, $quest_id = 0, $topic_id = 0, $content = NULL, $img = NULL, $right_answer_id = 0) {

        parent::__construct($dbo, $config);

        $this->quest_id         = empty ($quest_id) ? 0 : $quest_id;
        $this->topic_id         = empty ($topic_id) ? 0 : $topic_id;
        $this->content          = empty ($content) ? 0 : $content;
        $this->img              = empty ($img) ? NULL : $img;
        $this->right_answer_id  = empty ($right_answer_id) ? 0 : $right_answer_id;
    }

    public function addToDB() {

        if(empty($this->quest_id)){
            $query = "SELECT quest_id FROM questions WHERE topic_id='$this->topic_id' ORDER BY quest_id DESC LIMIT 1";

            $STH = $this->db->query($query);
            $STH->setFetchMode(PDO::FETCH_ASSOC);

            if($STH->rowCount() > 0){
                $result = $STH->fetch();
                $this->quest_id = ++$result["quest_id"];
            }
            else if ($STH->rowCount() == 0) {
                $this->quest_id = 1;
            }
        }
        $query = "INSERT INTO questions (quest_id, topic_id, content, img, right_answer_id) VALUES ($this->quest_id, '$this->topic_id', '$this->content', '$this->img', $this->right_answer_id)";
        $STH = $this->db->prepare($query);
        $STH->execute();

        return $this->quest_id;
    }

    public function updateContent(){

        $query = "UPDATE questions SET content='$this->content' WHERE (quest_id=$this->quest_id AND topic_id=$this->topic_id)";

        $STH = $this->db->prepare($query);
        $STH->execute();

        return true;
    }

    public function updateImg(){

        $query = "UPDATE questions SET img='$this->content' WHERE (quest_id=$this->quest_id AND topic_id=$this->topic_id)";

        $STH = $this->db->prepare($query);
        $STH->execute();

        return true;
    }

    public function updateRightAnsId(){

        $query = "UPDATE questions SET right_anwer_id='$this->right_answer_id' WHERE (quest_id=$this->quest_id AND topic_id=$this->topic_id)";

        $STH = $this->db->prepare($query);
        $STH->execute();

        return true;
    }

    // !
    public function updateTopicId(){

        $query = "UPDATE questions SET topic_id='$this->topic_id' WHERE (quest_id=$this->quest_id AND topic_id=$this->topic_id)";

        $STH = $this->db->prepare($query);
        $STH->execute();

        return true;
    }

    public function getDBHandler(){
        return $this->db;
    }
}

?>
