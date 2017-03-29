<?php
  // Initialize everything I'll need for the page
  // Use constants for everything

  // Define some constants
  //define( "PATH", "/home/interruptions/public_html/" );
  // define( "PATH_INC", PATH . "assets/inc/" );

  // Define a constant for all the URLs (assets like css, nav, js)
  //define ("URL", "http://interruptions.cias.rit.edu/");
  // define ("URL_CSS", URL . "assets/css/");
  // define ("URL_JS", URL . "assets/js/");

  // include any libraries / function filesize
  // initialize database connection
  // MAKE SURE TO ONLY USE FUNCTIONS WITH AN 'i' IN THEM - are part of an updated API
	require "/home/interruptions/db_conn.php";
	$link = mysqli_connect($host, $user, $pass, $name);

	if (!$link) {
		echo "connection error: " . mysqli_connect_error();

		// redirect: send php header to redirect (with 301 code)
		// header("Location: " . URL . "error.php");
		die();
	}
?>
