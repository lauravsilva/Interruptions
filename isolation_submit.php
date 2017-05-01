<?php
require_once "isolation.php";
require_once "assets/classes/DB.class.php";
require_once "assets/classes/util.php";

// convert posted keys to uppercase to match db entries
$postkey = strtoupper($_POST['key']);
$postpartnerkey = strtoupper($_POST['partnerkey']);

$key = '';
$partnerkey = '';
$name = '';
$age = '';
$email = '';
$color = '';


// TODO: if key doesn't exist, show error message
//try {
    if (isset($_POST['key']) and validateUserKey($postkey) === 1) {
        $key = $postkey;
    }

    if (isset($_POST['partnerkey']) and validateUserKey($postpartnerkey) === 1) {
        $partnerkey = $postpartnerkey;
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


updateDB($key, $partnerkey, $name, $age, $email, $color);


function updateDB($key, $partnerkey, $name, $age, $email, $color){
    $db = new DB();

    $db->addIsolationData($key, $partnerkey, $name, $age, $email, $color);
}
