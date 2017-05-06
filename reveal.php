<?php
require_once 'vendor/autoload.php';
require_once "assets/classes/DB.class.php";
require_once "assets/classes/util.php";

$db = new DB();

$activeUsersKeys = $db->getActiveUsersKeys();
$parsedUserKeys = parseActiveUserKeys($activeUsersKeys);



try {
    // specify where to look for templates
    $loader = new Twig_Loader_Filesystem('templates');
    // initialize twig environment
    $twig = new Twig_Environment($loader);

    // load template
    $template = $twig->loadTemplate('reveal.html');

    // set template variables and render template
    echo $template->render(array(
        'user1' => $parsedUserKeys[0]
        , 'user2' => $parsedUserKeys[1]
    ));

} catch (Exception $e) {
    die('ERROR: ' . $e->getMessage());
}

