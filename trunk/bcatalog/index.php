<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            require_once("source/config.php");
            require_once(MODEL_PATH."/user.model.php");
            require_once(MODEL_PATH."/question.model.php");

            try{
                $test = new Question(null, $config, 0, "road-signs", "qweqweqwe", null, 1);
                //echo $test->addToDB();
                //print_r($test->checkPass());

                /*
                 *
                 * http://drive-test.dev:8888/admin-panel/request_handler.php?obj=quest&cmd=add&topic_id=crossroads&content=%D0%B5%D1%85%D0%B0%D1%82%D1%8C%20%D0%BF%D1%80%D1%8F%D0%BC%D0%BE&right_answer_id=2&answers[]=%D0%BA%D0%B0%D0%BA%D0%B0%D0%BA%D0%B0&answers[]=no&answers[]=dont%20know
                 */

                echo serialize(array(
                    "obj" => "quest",
                    "cmd" => "add",
                    "topic_id" => "crossroads",
                    "content" => "можно ли ехать прямо",
                    "right_answer_id" => "2",
                    "answers" => array(
                        array("content"=>"можно"),
                        array("content"=>"нельзя"),
                        array("content"=>"совсем нельзя")
                    )
                ));
            }
            catch (Exception $exp){
                printf("<h1>Error:</h1>%s<br/>in: %s at: %d line<br/>", $exp->getMessage(), $exp->getFile(), $exp->getLine());
                print_r($exp->getTrace());
            }
        ?>
    </body>
</html>
