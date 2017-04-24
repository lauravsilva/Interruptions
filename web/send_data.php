<?php
    require "assets/inc/page_start.inc.php";
    require_once "assets/classes/DB.class.php";
    require_once "assets/classes/util.php";

    $db = new DB();

//    $answer = $db->getQuestion(1);
//    print_r($answer);

//    $dbColumnName = 'qRes1';
    $db->updateQuestionResponse('RX537Z','3', '2');

//$db->createUserWithSurveyData('RX537Y',array(1,3,5,7,9,11));