<?php
  require "assets/inc/page_start.inc.php";
  require_once 'assets/classes/DB.class.php';

  $db = new DB();
?>

<html>
<head>
    <title>Interruptions</title>

</head>

<body>
  <h1>Welcome!</h1>
  <?php
    $data = $db->getUserColors();
    foreach($data as $row){
  		print_r($row);
  	}
   ?>

</body>
</html>
