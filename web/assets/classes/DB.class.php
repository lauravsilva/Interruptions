<?php

class DB {
  private $connection;

  function __construct() {
    require_once("../../../../db_conn.php");
    $this->connection = new mysqli($host,$user,$pass,$db);
    if ($this->connection->connect_error) {
      //have an Error
      echo "connect failed: ".mysqli_connect_error();
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
