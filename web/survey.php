<?php
  require "assets/inc/page_start.inc.php";
  require_once "assets/classes/DB.class.php";
  require_once "assets/classes/util.php";

  define("NUMQS", "6");

  $db = new DB();
  
  
  for ($i = 1; $i <= NUMQS; $i++){
    $question = $db->getQuestion($i);
    $parsedQ = parseQuestion($question);
    $options = $db->getAllQuestionOptions($i);
    $parsedO = parseOptions($options);
}


  

?>
<html>

<head>
    <title>Interruptions</title>
</head>

<body>
    <h1>Survey</h1>
  
  </body>

</html>