<?php
require_once 'vendor/autoload.php';
require_once "assets/classes/DB.class.php";
require_once "assets/classes/util.php";

$db = new DB();


// Start the session
session_start();


try {
    // specify where to look for templates
    $loader = new Twig_Loader_Filesystem('templates');
    // initialize twig environment
    $twig = new Twig_Environment($loader);

    // load template
    $template = $twig->loadTemplate('thankyou.html');

    // set template variables and render template

    $userKey = null;
    if (isset($_SESSION['userKey'])){
        $userKey = $_SESSION["userKey"];
    }

    echo $template->render(array(
        'userKey' => $userKey
    ));

    if (isset($_SESSION['userKey'])) {
        session_destroy();
        $_SESSION["currentQ"] = 1;
    }

} catch (Exception $e) {
    die('ERROR: ' . $e->getMessage());
}
