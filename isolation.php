<?php
require_once 'vendor/autoload.php';
require_once "assets/classes/DB.class.php";
require_once "assets/classes/util.php";

// Start the session
session_start();

$db = new DB();

$errorMessage = '';

$reasons = array(
    "userKey" => "The user code entered could not be found. Please try again.",
    "partnerKey" => "The partner code entered could not be found. Please try again.",
    "color" => "Please select a color."
);

if (isset($_SESSION['errors'])) {
    $errorMessage = $reasons[$_SESSION['errors']];
}


try {
    // specify where to look for templates
    $loader = new Twig_Loader_Filesystem('templates');
    // initialize twig environment
    $twig = new Twig_Environment($loader);

    // load template
    $template = $twig->loadTemplate('isolation.html');

    // set template variables and render template
    echo $template->render(array(
        'error' => $errorMessage
    ));

    session_destroy();

} catch (Exception $e) {
    die('ERROR: ' . $e->getMessage());
}

