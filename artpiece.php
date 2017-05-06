<?php
	require_once "assets/classes/DB.class.php";
    require_once "assets/classes/util.php";

    $db = new DB();

    $userdata = $db->getQuestionResponses($_GET['user_key']);
    echo json_encode($userdata);
?>