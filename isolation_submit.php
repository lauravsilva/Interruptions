<?php
//require_once "isolation.php";
require_once "assets/classes/DB.class.php";
require_once "assets/classes/util.php";

// Start the session
session_start();

// convert posted keys to uppercase to match db entries
$postkey = strtoupper($_POST['key']);
$postpartnerkey = strtoupper($_POST['partnerkey']);

$key = '';
$partnerkey = '';
$username = '';
$age = '';
$email = '';
$color = '';

// variable that keeps track of errors
$formvalidation = '';

// form validation
if (isset($_POST['color'])){
    $color = $_POST['color'];
}
else {
    $color = '244f6a';
}

if (isset($_POST['name'])){
    $username = $_POST['name'];
}

if (isset($_POST['age'])){
    $age = $_POST['age'];
}

if (isset($_POST['email'])){
    $email = $_POST['email'];
}

if (isset($_POST['partnerkey']) and validateUserKey($postpartnerkey) === 1) {
    $partnerkey = $postpartnerkey;
} else {
    $_SESSION['errors'] = "partnerKey";
    $formvalidation = 'error';
}

if (isset($_POST['key']) and validateUserKey($postkey) === 1) {
    $key = $postkey;
} else {
    $_SESSION['errors'] = "userKey";
    $formvalidation = 'error';
}
// end form validation


// update db is there are no form validation errors
if ($formvalidation === ''){
    updateDB($key, $partnerkey, $username, $age, $email, $color);
}
else {
    echo $formvalidation;
}

// functions
function updateDB($key, $partnerkey, $username, $age, $email, $color){
    $db = new DB();

    $db->addIsolationData($key, $partnerkey, $username, $age, $email, $color);

    $activeUsersKeys = $db->getActiveUsersKeys();

    if (sizeof($activeUsersKeys) >= 2){
        // clear active users
        $db->updateAllOtherUsersInactive();
    }
    $db->updateActiveUserState($key);

    session_destroy();
}
