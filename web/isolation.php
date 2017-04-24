<?php
require_once 'vendor/autoload.php';
require_once "assets/classes/DB.class.php";
require_once "assets/classes/util.php";

$db = new DB();

//  $data = $db->getUserColors();
////  $data = $db->getAllQuestionOptions();
//  foreach($data as $row){
//    print_r($row);
//  }
//
//  $question = $db->getQuestion(1);
//    print_r($question);
//
//
//  $partner = $db->getPartnerData('ABC123');
//print_r($partner);


//if (isset($_POST['key']) &&
//    isset($_POST['name']) && isset($_POST['color']) && isset($_POST['email'])
//) {
//    $db = new DB();
//    $db->addIsolationData($_POST['key'], $_POST['name'], $_POST['color'], $_POST['email']);
//}
//
//$results = array(2, 7, 6, 5, 4);
//$userKey = getToken();
//$createUser = $db->createUserWithSurveyData($userKey, $results);


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

