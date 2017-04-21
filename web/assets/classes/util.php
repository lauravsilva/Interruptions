<?php
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


function getToken()
{
    $length = 6;
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


// Parse question data
function parseQuestion($question){
    $data = '';
    foreach($question as $key => $val){
      foreach($val as $key2 => $val2){
        if ($key2 === 'questionText'){
            $data = $val2;
//          array_push($data, $val2);
//          echo $val2;
        }
      }
    }
    return $data;
}

function parseOptions($options){
    $data = [];
  foreach($options as $opKey => $opVal){
    foreach($opVal as $opKey2 => $opVal2){
      if ($opKey2 === 'answerText'){
          array_push($data, $opVal2);
//        echo ">> " . $opVal2 . "<br/>";
      }
    }
  }
  return $data;
}

// Start the session
//session_start();

// remove all session variables
//session_unset();

// destroy the session
//session_destroy();

//$_SESSION["userKey"] != "")



function setSession(){
    // Set session variables
    $_SESSION["userKey"] = getToken();
    $_SESSION["currentQ"] = 1;
}
