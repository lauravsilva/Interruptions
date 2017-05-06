<?php
$tmpfname = tempnam("assets/artpieces",$_POST['userKey1'] . $_POST['userKey2']);

$fp = fopen($tmpfname . ".png", "w");
fwrite($fp, base64_decode(explode(",", $_POST['data'])[1]));
fclose($fp);
unlink($tmpfname);

?>