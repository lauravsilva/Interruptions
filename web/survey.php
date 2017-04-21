<?php
require_once 'vendor/autoload.php';
require_once "assets/classes/DB.class.php";
require_once "assets/classes/util.php";

$db = new DB();

define("NUMQS", "6");
$allQuestionsData = [];

for ($i = 1; $i <= NUMQS; $i++) {
    $question = $db->getQuestion($i);
    $parsedQ = parseQuestion($question);
    $options = $db->getAllQuestionOptions($i);
    $parsedO = parseOptions($options);

    $thisQData = (array($parsedQ, $parsedO));
    array_push($allQuestionsData, $thisQData);
}

setSession();

try {
    // specify where to look for templates
    $loader = new Twig_Loader_Filesystem('templates');
    // initialize twig environment
    $twig = new Twig_Environment($loader);

    // load template
    $template = $twig->loadTemplate('survey.html');

    // set template variables and render template
    echo $template->render(array(
        'questionData' => $allQuestionsData[$_SESSION["currentQ"]],
        'userKey' => $_SESSION["userKey"],
        'currentQuestion' => $_SESSION["currentQ"]
    ));

//      echo $twig->render('index.html', array(
//          'name' => 'USCSS Nostrome',
//          'products' => array('1', '2', '3')
//      ));

} catch (Exception $e) {
    die('ERROR: ' . $e->getMessage());
}
