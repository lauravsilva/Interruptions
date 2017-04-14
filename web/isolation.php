<?php
  //require "assets/inc/page_start.inc.php";
  require_once "assets/classes/DB.class.php";
  require_once "assets/classes/util.php";

  $db = new DB();

      
//  $data = $db->getUserColors();
////  $data = $db->getAllQuestionOptions();
//  foreach($data as $row){
//    print_r($row);
//  }
//
//  $question = $db->getQuestion(1);
//    print_r($question);
//
//
//  $partner = $db->getPartnerData('ABC123');
//print_r($partner);

$userKey = getToken(6);



            

    if (isset($_POST['key']) && isset($_POST['name']) && isset($_POST['color']) && isset($_POST['email'])) {
        $db->addIsolationData($_POST['key'], $_POST['name'], $_POST['color'], $_POST['email']);
    }
    
//    $results = array(1,7,6,5,4);  
      
//    $createUser = $db->createUserWithSurveyData($userKey ,$results);

?>
    <html>

    <head>
        <title>Isolation</title>
    </head>

    <body>
        <h1>Isolation</h1>
        <form class="form-createUser" role="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
            <input type="text" name="key" placeholder="User Key">
            <br/>
            <input type="text" name="name" placeholder="Name">
            <br/>
            <input type="text" name="color" placeholder="Color">
            <br/>
            <input type="email" name="email" placeholder="Email">
            <br/>
            <button class="btn btn-fav" type="submit" name="createUser">Submit</button>
        </form>
    </body>

    </html>