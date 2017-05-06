<?php
require_once "assets/classes/DB.class.php";
require_once "assets/classes/util.php";

$db = new DB();

// Get access to button pressed and button order:

if (isset($_POST['buttonPressed'])){
    $buttonPressed = $_GET['value'];
}
if (isset($_POST['buttonOrder'])) {
    $buttonOrder = $_GET['buttonOrder'];
}

// temps
$buttonPressed = '16';
$buttonOrder = '1';


$activeUsersKeys = $db->getActiveUsersKeys();
$parsedUserKeys = parseActiveUserKeys($activeUsersKeys);

if (sizeof($parsedUserKeys) === 2){
    $db->updateButtonQuestion($parsedUserKeys[0], $buttonPressed, $buttonOrder);
    $db->updateButtonQuestion($parsedUserKeys[1], $buttonPressed, $buttonOrder);
}



