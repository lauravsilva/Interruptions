<?php
  require_once 'vendor/autoload.php';
  require_once "assets/classes/DB.class.php";
  require_once "assets/classes/util.php";

    $db = new DB();

    $question = $db->getQuestion(0);
    $parsedQ = parseQuestion($question);
    $options = $db->getAllQuestionOptions(0);
    $parsedO = parseOptions($options);


  try {
      // specify where to look for templates
      $loader = new Twig_Loader_Filesystem('templates');
      // initialize twig environment
      $twig = new Twig_Environment($loader);

      // load template
      $template = $twig->loadTemplate('survey_static.html');

      // set template variables and render template
      echo $template->render(array(
          'question' => $question,
            'parsedQ' => $parsedQ,
            'options' => $parsedO,
            'test' => 'test123'
      ));

//      echo $twig->render('index.html', array(
//          'name' => 'USCSS Nostrome',
//          'products' => array('1', '2', '3')
//      ));
  } catch(Exception $e){
      die('ERROR: ' . $e->getMessage());
  }
?>