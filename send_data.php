<?php
    require_once "assets/classes/DB.class.php";
    require_once "assets/classes/util.php";

    $db = new DB();


    $bar = $db->updateAllOtherUsersInactive();

    $foo = $db->updateActiveUserState('MKII0');
    $foo = $db->updateActiveUserState('3L5PR');

    $keys = $db->getActiveUsersKeys();

    print_r($foo);
    print_r($bar);
    print_r(sizeof($keys));

