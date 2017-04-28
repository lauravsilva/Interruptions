<?php
require_once "survey.php";
require_once "assets/classes/DB.class.php";
require_once "assets/classes/util.php";

// Start the session
session_start();

if ($_POST['action'] == 'call_this') {

    $val = $_POST['value'];

    updateDB($val);

    // Increment currentQ
    $_SESSION["currentQ"] = intval($_SESSION["currentQ"]) + 1;
}

function updateDB($response){
    $db = new DB();

    // create user and save 1st response
    if ($_SESSION["currentQ"] == 1){
        $db->createUserWithQOne($_SESSION["userKey"], $response);
    }
    // save response for all other questions
    else {
        $db->updateQuestionResponse($_SESSION["userKey"], $response, intval($_SESSION["currentQ"]));
    }
}
