<?php
require_once 'vendor/autoload.php';
require_once "assets/classes/DB.class.php";
require_once "assets/classes/util.php";

$db = new DB();

$activeUsersKeys = $db->getActiveUsersKeys();
$parsedUserKeys = parseActiveUserKeys($activeUsersKeys);

$piecename = $db->getArtPieceName($parsedUserKeys[0]);
$parsedpiecename = parsePieceName($piecename);



try {
    // specify where to look for templates
    $loader = new Twig_Loader_Filesystem('templates');
    // initialize twig environment
    $twig = new Twig_Environment($loader);

    // load template
    $template = $twig->loadTemplate('revealed.html');

    // set template variables and render template
    echo $template->render(array(
        'artpiecename' => "/assets/artpieces/" . $parsedpiecename,
        'userKey1' => $parsedUserKeys[0],
        'userKey2' => $parsedUserKeys[1]
    ));

} catch (Exception $e) {
    die('ERROR: ' . $e->getMessage());
}

