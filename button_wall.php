<?php
require_once "assets/classes/DB.class.php";
require_once "assets/classes/util.php";

$db = new DB();

// Get access to button pressed and button order:
$buttonPressed1 = '';
$buttonPressed2 = '';
$buttonPressed3 = '';

if (isset($_GET['v1'])){
    $buttonPressed1 = $_GET['v1'];
}
if (isset($_GET['v2'])){
    $buttonPressed2 = $_GET['v2'];
}
if (isset($_GET['v3'])){
    $buttonPressed3 = $_GET['v3'];
}

$activeUsersKeys = $db->getActiveUsersKeys();
$parsedUserKeys = parseActiveUserKeys($activeUsersKeys);

if (sizeof($parsedUserKeys) === 2){
    $db->updateButtonQuestion($parsedUserKeys[0], $buttonPressed1, $buttonPressed2, $buttonPressed3);
    $db->updateButtonQuestion($parsedUserKeys[1], $buttonPressed1, $buttonPressed2, $buttonPressed3);
}





