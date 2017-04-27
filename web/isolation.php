<?php
require_once 'vendor/autoload.php';
require_once "assets/classes/DB.class.php";
require_once "assets/classes/util.php";

$db = new DB();




try {
    // specify where to look for templates
    $loader = new Twig_Loader_Filesystem('templates');
    // initialize twig environment
    $twig = new Twig_Environment($loader);

    // load template
    $template = $twig->loadTemplate('isolation.html');

    // set template variables and render template
    echo $template->render(array(
        'test' => 'test'
    ));

} catch (Exception $e) {
    die('ERROR: ' . $e->getMessage());
}

