<?php

// Source: http://stackoverflow.com/questions/1846202/php-how-to-generate-a-random-unique-alphanumeric-string
function crypto_rand_secure($min, $max)
{
    $range = $max - $min;
    if ($range < 1) return $min; // not so random...
    $log = ceil(log($range, 2));
    $bytes = (int)($log / 8) + 1; // length in bytes
    $bits = (int)$log + 1; // length in bits
    $filter = (int)(1 << $bits) - 1; // set all lower bits to 1
    do {
        $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
        $rnd = $rnd & $filter; // discard irrelevant bits
    } while ($rnd > $range);
    return $min + $rnd;
}


function getToken()
{
    $length = 5;
    $token = "";
    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
//    $codeAlphabet = "abcdefghijklmnopqrstuvwxyz";
    $codeAlphabet .= "0123456789";
    $max = strlen($codeAlphabet); // edited

    for ($i = 0; $i < $length; $i++) {
        $token .= $codeAlphabet[crypto_rand_secure(0, $max - 1)];
    }

    return $token;
}


// Parse question data
function parseQuestion($question){
    $data = '';
    foreach ($question as $key => $val) {
        foreach ($val as $key2 => $val2) {
            if ($key2 === 'questionText') {
                $data = $val2;
            }
        }
    }
    return $data;
}

function parseOptions($options){
    $data = [];
    foreach ($options as $opKey => $opVal) {
        foreach ($opVal as $opKey2 => $opVal2) {
            if ($opKey2 === 'answerText') {
                array_push($data, $opVal2);
            }
        }
    }
    return $data;
}


// Parse question data
function parsePartnerName($partnerData, $nameofcolumn){
    $value = '';
    foreach ($partnerData as $key => $val) {
        foreach ($val as $key2 => $val2) {
            if ($key2 === $nameofcolumn) {
                $value = $val2;
            }
        }
    }
    return $value;
}

function parseActiveUserKeys($activeUsersKeys){
    $data = [];
    foreach ($activeUsersKeys as $opKey => $opVal) {
        foreach ($opVal as $opKey2 => $opVal2) {
            if ($opKey2 === 'userKey') {
                array_push($data, $opVal2);
            }
        }
    }
    return $data;
}


function setSession()
{
    $db = new DB();
    $userKeys = $db->getAllUserKeys();
    $data = [];

    $generateKey = getToken();

    foreach ($userKeys as $key => $val) {
        foreach ($val as $key2 => $val2) {
            if ($key2 === 'userKey') {
                array_push($data, $val2);
            }
        }
    }

    // Make sure the generated key doesn't already exist in db
    while (in_array($generateKey, $data, true)) {
        $generateKey = getToken();
    }

    // Set session variables
    $_SESSION["userKey"] = $generateKey;
    $_SESSION["currentQ"] = 1;
}

function redirect($url, $statusCode = 303)
{
    header('Location: ' . $url, true, $statusCode);
    die();
}

function validateUserKey($keyToCheck)
{
    $db = new DB();
    $data = [];
    $result = 0;

    $userKeys = $db->getAllUserKeys();

    foreach ($userKeys as $key => $val) {
        foreach ($val as $key2 => $val2) {
            if ($key2 === 'userKey') {
                array_push($data, $val2);
            }
        }
    }

    if (in_array($keyToCheck, $data, true)) {
        $result = 1;
    }

    return $result;
}