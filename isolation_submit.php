<?php
require_once "isolation.php";
require_once "assets/classes/DB.class.php";
require_once "assets/classes/util.php";

//// Start the session
//session_start();

//  $data = $db->getUserColors();
////  $data = $db->getAllQuestionOptions();
//  foreach($data as $row){
//    print_r($row);
//  }
//
//  $question = $db->getQuestion(1);
//    print_r($question);
//
//
//  $partner = $db->getPartnerData('ABC123');
//print_r($partner);

$key = '';
$name = '';
$age = '';
$email = '';
$color = '';

// TODO: if key doesn't exist, show error message
//try {
    if (isset($_POST['key']) and validateUserKey($_POST['key']) === 1) {
        $key = $_POST['key'];
    }
//}
//catch(Exception $e){
//    echo 'Sorry, there was an error: ' . $e->getMessage();
//}


if (isset($_POST['name'])){
    $name = $_POST['name'];
}
if (isset($_POST['age'])){
    $age = $_POST['age'];
}
if (isset($_POST['email'])){
    $email = $_POST['email'];
}
if (isset($_POST['color'])){
    $color = $_POST['color'];
}


updateDB($key, $name, $age, $email, $color);


function updateDB($key, $name, $age, $email, $color){
    $db = new DB();

    $db->addIsolationData($key, $name, $age, $email, $color);

}
