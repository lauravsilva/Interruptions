<?php

	require "assets/inc/page_start.inc.php";
	require_once "assets/classes/DB.class.php";
	require_once "assets/classes/util.php";

	$db = new DB();

	$answer = $db->getQuestion(1);
	print_r($answer);
?>