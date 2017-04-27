<?php
//    require_once "survey.php";
    require_once "assets/classes/DB.class.php";
    require_once "assets/classes/util.php";

    $db = new DB();

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

$key = '';
$name = '';
$age = '';
$email = '';
$color = '';


$_POST['key'] = 'UT3M38';

//&& validateUserKey($_POST['key']) === 1
if (isset($_POST['key']) and validateUserKey($_POST['key']) === 1){
    echo 'key isset';
//    if (validateUserKey($_POST['key']) === 1){
        echo 'key === 1';
//    }
    $key = $_POST['key'];
}
else {
    // handle error
    echo 'key else';
//    return;
}

if (isset($_POST['name'])){
    echo 'name isset';
    $name = $_POST['name'];
}
if (isset($_POST['age'])){
    echo 'age isset';
    $age = $_POST['age'];
}
if (isset($_POST['email'])){
    echo 'email isset';
    $email = $_POST['email'];
}
if (isset($_POST['color'])){
    echo 'color isset';
    $color = $_POST['color'];
}


updateDB($key, $name, $age, $email, $color);


function updateDB($key, $name, $age, $email, $color){
    $db = new DB();

    $db->addIsolationData($key, $name, $age, $email, $color);

}