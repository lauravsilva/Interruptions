<?php

class DB {
  private $db;

  function __construct(){
    require_once("../../../dbInfo.php");
    try {
      $this->dbh = new PDO("mysql:host=$host;dbname=$db;",$user,$pass);

      //change error reporting
      $this->dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
      echo $e->getMessage();
      die();
    }
  }

  // function getPhoneNumbersAsTable(){
  //   $data = $this->getPhoneNumbers($_GET["personID"]);
  //   echo count($data);
  //   if (count($data) > 0) {
  //     $bigString = "<table border='1'>\n
  //                     <tr><th>Person ID</th><th>Phone Type</th><th>Phone #</th><th>Area Code</th></tr>\n";
  //     foreach($data as $row) {
  //         $bigString .= "<tr><td><a href='Lab4_2.php?id={$row['id']}'>{$row['id']}</a></td>
  //                       <td>{$row['phonetype']}</td><td>{$row['phonenum']}</td><td>{$row['areacode']}</td></tr>\n";
  //
  //     }
  //
  //     $bigString .= "</table>\n";
  //   } else {
  //     $bigString = "<h2>No people exist</h2>";
  //   }
  //
  //   return $bigString;
  // }


}
