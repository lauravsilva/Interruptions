<?php

class DB {
  private $db;

  function __construct(){
    require_once("../../../db_conn.php");
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



}
