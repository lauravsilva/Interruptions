<?php
require_once "survey.php";
require_once "assets/classes/DB.class.php";
require_once "assets/classes/util.php";

// Start the session
session_start();

if ($_POST['action'] == 'call_this') {
    // TODO: Update response!
    $val = $_POST['value'];
    updateDB($val);

    // Increment currentQ
    if ($_SESSION["currentQ"] >= NUMQS) {
        // TODO: REDIRECT TO THANK YOU PAGE!!!
//        $_SESSION["currentQ"] = 1;
        session_destroy();
    }

    else {
        $_SESSION["currentQ"] = intval($_SESSION["currentQ"]) + 1;
    }
}

function updateDB($response){
    $db = new DB();

    $db->updateQuestionResponse($_SESSION["userKey"], $response, intval($_SESSION["currentQ"]));

}