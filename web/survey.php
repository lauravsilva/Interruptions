<?php
require_once 'vendor/autoload.php';
require_once "assets/classes/DB.class.php";
require_once "assets/classes/util.php";

$db = new DB();

// TODO: Adjust numquestions
define("NUMQS", "6");
$allQuestionsData = [];

// Start the session
session_start();

//TODO: Only execute this code once
for ($i = 1; $i <= NUMQS; $i++) {
    $question = $db->getQuestion($i);
    $parsedQ = parseQuestion($question);
    $options = $db->getAllQuestionOptions($i);
    $parsedO = parseOptions($options);

    $thisQData = (array($parsedQ, $parsedO));
    array_push($allQuestionsData, $thisQData);
}

try {
    // specify where to look for templates
    $loader = new Twig_Loader_Filesystem('templates');
    // initialize twig environment
    $twig = new Twig_Environment($loader);

    // load template
    $template = $twig->loadTemplate('survey.html');

    // set template variables and render template
    if (!isset($_SESSION['userKey'])) {
        setSession();
    }

    if ($_SESSION["currentQ"] === NUMQS+1 ){
        redirect("thankyou.php");
        return;
    }

    echo $template->render(array(
        'questionData' => $allQuestionsData[$_SESSION["currentQ"] - 1],
        'userKey' => $_SESSION["userKey"],
        'currentQuestionNum' => intval($_SESSION["currentQ"]),
        'totalQuestionNum' => NUMQS,
        'percentProgress' => (intval($_SESSION["currentQ"])/NUMQS) * 100
    ));
} catch (Exception $e) {
    die('ERROR: ' . $e->getMessage());
}


