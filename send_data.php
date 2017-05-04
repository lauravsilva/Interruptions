<?php
//    require_once "survey.php";
    require_once "assets/classes/DB.class.php";
    require_once "assets/classes/util.php";

    $db = new DB();

    $userdata = $db->getAllUsersData();
    print_r($userdata);

// Start the session
//session_start();
//
//echo  $_SESSION["userKey"] . '<br/>';
//echo  $_SESSION["currentQ"] . '<br/>';

//    $answer = $db->getQuestion(1);
//    print_r($answer);

//    $dbColumnName = 'qRes1';
//    $db->updateQuestionResponse($_SESSION["userKey"],'50', $_SESSION["currentQ"]);

//    $db->createUserWithQOne($_SESSION["userKey"],'55');

//$db->createUserWithSurveyData('RX537Y',array(1,3,5,7,9,11));

//
//echo '<script type="text/javascript">window.location = "thankyou.php"</script>';



//redirect("thankyou.php");
//return;