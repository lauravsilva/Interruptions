<?php


class DB {
  private $db;

  function __construct(){
    require("/mnt/websan/powerwww/home/interruptions/public_html/db_conn.php");
      
    try {
      $this->dbh = new PDO("mysql:host=$host;dbname=$name;",$user,$pass);

      //change error reporting
      $this->dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }
      catch(PDOException $e) {
      echo $e->getMessage();
      die();
    }
  }

  // function funcName($param){
  //   try{
  //     $data = array();
  //     $stmt = $this->dbh->prepare("mySQL query here...");
  //     $stmt->execute(array('param'=>$param)); //can use id w/ or w/out colon (:id)
  //     while($row = $stmt->fetch()){
  //       $data[] = $row;
  //     }
  //     return $data;
  //   } catch(PDOException $e) {
  //     echo $e->getMessage();
  //     die();
  //   }
  // }

  function getUserColors(){
    try{
      $data = array();
      $stmt = $this->dbh->prepare("select * from user");
      $stmt->execute(); //can use id w/ or w/out colon (:id)
      while($row = $stmt->fetch()){
          $data[] = $row;
        }
        return $data;
      } 
      catch(PDOException $e) {
        echo $e->getMessage();
        die();
      }
  }
    
function getQuestion($questionID){
    echo("Da host: " . $host); //Debug
    try{
      $data = array();
      $stmt = $this->dbh->prepare("SELECT * from questions WHERE questionID = " . $questionID);
      $stmt->execute();
      while($row = $stmt->fetch()){
          $data[] = $row;
        }
        return $data;
      } 
      catch(PDOException $e) {
        echo $e->getMessage();
        die();
      }
    }

function getAllQuestionOptions($questionID){
    try{
      $data = array();
      $stmt = $this->dbh->prepare("SELECT answers.answerText, questions.questionID FROM answers INNER JOIN questions ON answers.questionID = questions.questionID WHERE answers.questionID = " . $questionID);
      $stmt->execute(); //can use id w/ or w/out colon (:id)
      while($row = $stmt->fetch()){
          $data[] = $row;
        }
        return $data;
      } 
      catch(PDOException $e) {
        echo $e->getMessage();
        die();
      }
  }
    
  // TO DO
  function updateQuestionResponse($userID, $questionNum, $questionRes){
     try{
       $data = array();
       $stmt = $this->dbh->prepare("UPDATE user SET qRes1 = 2 WHERE user.userID = 3");
//       $stmt = $this->dbh->prepare("UPDATE user SET " . $questionNum . " = " . $questionRes . " WHERE user.userID = " . $userKey);
      $stmt->execute(); //can use id w/ or w/out colon (:id)
//       $stmt->execute(array('param'=>$param)); //can use id w/ or w/out colon (:id)
       while($row = $stmt->fetch()){
         $data[] = $row;
       }
       return $data;
     } catch(PDOException $e) {
       echo $e->getMessage();
       die();
     }
   }
  
    
    function getPartnerData($partnerKey){
     try{
       $data = array();
       $stmt = $this->dbh->prepare("SELECT * from user WHERE userKey = '" . $partnerKey . "'");
      $stmt->execute(); //can use id w/ or w/out colon (:id)
       while($row = $stmt->fetch()){
         $data[] = $row;
       }
       return $data;
     } 
      catch(PDOException $e) {
       echo $e->getMessage();
       die();
     }
   }    

  function createUserWithSurveyData($userKey, $results){
    try{
       $stmt = $this->dbh->prepare("INSERT INTO user (userKey, qRes1, qRes2, qRes3, qRes4, qRes5) VALUES (:userKey, :val1, :val2, :val3, :val4, :val5)");
       $stmt->execute(array(
         'userKey'=>$userKey,
         'val1'=>$results[0],
         'val2'=>$results[1],
         'val3'=>$results[2],
         'val4'=>$results[3],
         'val5'=>$results[4]
       ));
       return $this->dbh->lastInsertId();
     } 
    catch(PDOException $e) {
       echo $e->getMessage();
       die();
     }
    
  }
  
    function addIsolationData($userKey, $userName, $color, $email){   
     try{
       $stmt = $this->dbh->prepare("UPDATE user SET userName = :userName, userColor = :color, userEmail = :userEmail WHERE userKey = :userKey");
      $stmt->execute(array(
          "userKey"=>$userKey,
          "userName"=>$userName,
          "color"=>$color,
          "userEmail"=>$email
      )); 
      return $this->dbh->lastInsertId();
     } 
      catch(PDOException $e) {
       echo $e->getMessage();
       die();
     }
   }    
}
?>