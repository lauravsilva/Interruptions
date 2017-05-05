<?php
    require_once "assets/classes/DB.class.php";
    require_once "assets/classes/util.php";

    $db = new DB();


//    $bar = $db->updateAllOtherUsersInactive();
//
//    $foo = $db->updateActiveUserState('MKII0');
//    $foo = $db->updateActiveUserState('3L5PR');
//
//    $keys = $db->getActiveUsersKeys();
//
//    print_r($foo);
//    print_r($bar);
//    print_r(sizeof($keys));


// Get access to button pressed and button order:
$buttonPressed = '16';
$buttonOrder = '1';


$activeUsersKeys = $db->getActiveUsersKeys();
$parsedUserKeys = parseActiveUserKeys($activeUsersKeys);

echo 'Active Users Keys <br/>';
print_r($activeUsersKeys);
echo '<br/>Parsed User Keys <br/>';
print_r($parsedUserKeys);


$db->updateButtonQuestion($parsedUserKeys[0], $buttonPressed, $buttonOrder);
$db->updateButtonQuestion($parsedUserKeys[1], $buttonPressed, $buttonOrder);


