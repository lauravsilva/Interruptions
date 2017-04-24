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


// Start the session
if(!session_id()) session_start();
//    session_start();

try {


    if (session_status() == PHP_SESSION_NONE) {
// && $_SESSION["userKey"] != ""
        setSession();
//    echo 'session set';
    }
//else {
//    echo 'session already exists: ' . $_SESSION["userKey"];
//}
//
//if ($_SESSION["currentQ"] > NUMQS) {
//    // TODO: REDIRECT TO THANK YOU PAGE!!!
//    $_SESSION["currentQ"] = 1;
//}
//




    // specify where to look for templates
    $loader = new Twig_Loader_Filesystem('templates');
    // initialize twig environment
    $twig = new Twig_Environment($loader);

    // load template
    $template = $twig->loadTemplate('survey.html');

    // set template variables and render template
    echo $template->render(array(
        'questionData' => $allQuestionsData[$_SESSION["currentQ"]-1],
        'userKey' => $_SESSION["userKey"],
        'currentQuestionNum' => intval($_SESSION["currentQ"]),
        'totalQuestionNum' => NUMQS,
        'percentProgress' => intval($_SESSION["currentQ"]) * 10
    ));

} catch (Exception $e) {
    die('ERROR: ' . $e->getMessage());
}
