<?php


class DB
{
    private $db;

    function __construct()
    {
        // Server path
        $path = "/mnt/websan/powerwww/home/interruptions/public_html/db_conn.php";
        // Local path
//        $path = "/Users/lauravsilva/Desktop/Interruptions/db_conn.php";

        require "$path";

        try {
            $this->dbh = new PDO("mysql:host=$host;dbname=$name;", $user, $pass);

            //change error reporting
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
    }

    // function funcName($param){
    //   try{
    //     $data = array();
    //     $stmt = $this->dbh->prepare("mySQL query here...");
    //     $stmt->execute(array('param'=>$param));
    //     while($row = $stmt->fetch()){
    //       $data[] = $row;
    //     }
    //     return $data;
    //   } catch(PDOException $e) {
    //     echo $e->getMessage();
    //     die();
    //   }
    // }

    // Get all user data
    function getAllUsersData()
    {
        try {
            $data = array();
            $stmt = $this->dbh->prepare("select * from user");
            $stmt->execute();
            while ($row = $stmt->fetch()) {
                $data[] = $row;
            }
            return $data;
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
    }

    // Get all userKeys data
    function getAllUserKeys()
    {
        try {
            $data = array();
            $stmt = $this->dbh->prepare("select userKey from user");
            $stmt->execute();
            while ($row = $stmt->fetch()) {
                $data[] = $row;
            }
            return $data;
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
    }

// Get a question based on the questionID  
    function getQuestion($questionID)
    {
        try {
            $data = array();
            $stmt = $this->dbh->prepare("SELECT * from questions WHERE questionID = :qID");
            $stmt->execute(array(
                'qID' => $questionID
            ));
            while ($row = $stmt->fetch()) {
                $data[] = $row;
            }
            return $data;
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
    }

    // Get all question options for specific questionID
    function getAllQuestionOptions($questionID)
    {
        try {
            $data = array();
            $stmt = $this->dbh->prepare("SELECT answers.answerText, questions.questionID FROM answers INNER JOIN questions ON answers.questionID = questions.questionID WHERE answers.questionID = :qID");
            $stmt->execute(array(
                'qID' => $questionID));
            while ($row = $stmt->fetch()) {
                $data[] = $row;
            }
            return $data;
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
    }

    // create user on the db and add response to q1
    function createUserWithQOne($userKey, $questionRes) {
        try {
            $stmt = $this->dbh->prepare("INSERT INTO user (userKey, qRes1) VALUES (:userKey, :res1)");
            $stmt->execute(array(
                'userKey' => $userKey,
                'res1' => $questionRes
            ));
            return $this->dbh->lastInsertId();
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
    }

    // update one question response based on userKey and questionNum
    function updateQuestionResponse($userKey, $questionRes, $questionNum) {
        $columnName = 'qRes' . $questionNum;

        try {
            $stmt = $this->dbh->prepare("UPDATE user SET $columnName = :qRes WHERE userKey = :userKey");
            $stmt->execute(array(
                'userKey' => $userKey,
                'qRes' => $questionRes
            ));

            return $this->dbh->lastInsertId();
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
    }

    // Get access to partner data from their partnerKey
    function getPartnerData($partnerKey)
    {
        try {
            $data = array();
            $stmt = $this->dbh->prepare("SELECT * from user WHERE userKey = :partnerKey");
            $stmt->execute(array(
                'partnerKey' => $partnerKey
            ));
            while ($row = $stmt->fetch()) {
                $data[] = $row;
            }
            return $data;
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
    }

    // Update row with userKey to add name, color, email (isolation data)
    function addIsolationData($userKey, $partnerkey, $userName, $age, $email, $color)
    {
        $timestamp = date("Y-m-d H:i:s");

        try {
            $stmt = $this->dbh->prepare("UPDATE user SET userName = :userName, partnerkey = :partnerkey, userColor = :color, userEmail = :userEmail, userAge = :userAge, timeStamp = :timestamp WHERE userKey = :userKey");
            $stmt->execute(array(
                "userKey" => $userKey,
                "userName" => $userName,
                "partnerkey" => $partnerkey,
                "color" => $color,
                "userEmail" => $email,
                "userAge" => $age,
                "timestamp" => $timestamp
            ));
            return $this->dbh->lastInsertId();
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
    }

    // Update partnerKey
    function updatePartnerKey($userKey, $partnerKey)
    {
        try {
            $stmt = $this->dbh->prepare("UPDATE user SET partnerKey = :partnerKey WHERE userKey = :userKey");
            $stmt->execute(array(
                "userKey" => $userKey,
                "partnerKey" => $partnerKey
            ));
            return $this->dbh->lastInsertId();
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
    }

    // update the button pressed based on userKey and questionNum
    //$buttonOrder should be '1', '2' or '3'
    function updateButtonQuestion($userKey, $buttonPressed, $buttonOrder) {
        $columnName = 'button' . $buttonOrder;

        try {
            $stmt = $this->dbh->prepare("UPDATE user SET $columnName = :button WHERE userKey = :userKey");
            $stmt->execute(array(
                'userKey' => $userKey,
                'button' => $buttonPressed
            ));
            return $this->dbh->lastInsertId();
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
    }

    function getQuestionResponse($userKey, $questionNum){
        try {
            $columnName = 'qRes' . $questionNum;

            $data = array();
            $stmt = $this->dbh->prepare("SELECT $columnName from user WHERE userKey = :userKey");
            $stmt->execute(array(
                'userKey' => $userKey
            ));
            while ($row = $stmt->fetch()) {
                $data[] = $row;
            }
            return $data;
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
    }
}
