<?php

class DB {
  private $db;

  function __construct(){
    require("/mnt/websan/powerwww/home/interruptions/public_html/db_conn.php");
    try {
      $this->dbh = new PDO("mysql:host=$host;dbname=$name;",$user,$pass);

      //change error reporting
      $this->dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
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
      } catch(PDOException $e) {
        echo $e->getMessage();
        die();
      }
  }
    
function getQuestion($questionID){
    try{
      $data = array();
      $stmt = $this->dbh->prepare("SELECT * from questions WHERE questionID = " . $questionID);
      $stmt->execute();
      while($row = $stmt->fetch()){
          $data[] = $row;
        }
        return $data;
      } catch(PDOException $e) {
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
      } catch(PDOException $e) {
        echo $e->getMessage();
        die();
      }
  }
    
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
     } catch(PDOException $e) {
       echo $e->getMessage();
       die();
     }
   }    

}


// Source: http://stackoverflow.com/questions/1846202/php-how-to-generate-a-random-unique-alphanumeric-string    	

function crypto_rand_secure($min, $max)
{
    $range = $max - $min;
    if ($range < 1) return $min; // not so random...
    $log = ceil(log($range, 2));
    $bytes = (int) ($log / 8) + 1; // length in bytes
    $bits = (int) $log + 1; // length in bits
    $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
    do {
        $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
        $rnd = $rnd & $filter; // discard irrelevant bits
    } while ($rnd > $range);
    return $min + $rnd;
}

function getToken($length)
{
    $token = "";
    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
//    $codeAlphabet = "abcdefghijklmnopqrstuvwxyz";
    $codeAlphabet.= "0123456789";
    $max = strlen($codeAlphabet); // edited

    for ($i=0; $i < $length; $i++) {
        $token .= $codeAlphabet[crypto_rand_secure(0, $max-1)];
    }

    return $token;
}
