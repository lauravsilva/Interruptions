<?php
	require_once "assets/classes/DB.class.php";
    require_once "assets/classes/util.php";

	$filename =  $_POST['userKey1'] . $_POST['userKey2'] . ".png";
	
	
$fp = fopen('assets/artpieces/' . $filename, "w");
fwrite($fp, base64_decode(explode(",", $_POST['data'])[1]));
fclose($fp);
unlink($tmpfname);

$db = new DB();

$db->updateArtPieceName($_POST['userKey1'], $filename);
$db->updateArtPieceName($_POST['userKey2'], $filename);

?>