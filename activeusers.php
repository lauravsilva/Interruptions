<?php
	require_once "assets/classes/DB.class.php";
    require_once "assets/classes/util.php";

    $db = new DB();

	$useractive = $db->getActiveUsersKeys();
    echo json_encode($useractive);
?>