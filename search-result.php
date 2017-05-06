<?php

  require_once "assets/classes/DB.class.php";
  $db = new DB();

  require_once "assets/classes/util.php";

  require "db_conn.php";
  $link = mysqli_connect($host, $user, $pass, $name);

  if (!$link) {
    echo "connection error: " . mysqli_connect_error();
  }

  $query = "select * from user";
  $result = mysqli_query($link,$query);
?>

<html>
<head>
  <meta charset="utf-8">
  <title>Interruptions | Gallery</title>
  <meta name="description" content="">
  <meta name="author" content="">
  <!-- Mobile Specific Metas
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- FONT
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <script src="https://use.typekit.net/zst6xie.js"></script>
  <script>
      try {
          Typekit.load({
              async: true
          });
      }
      catch (e) {
      }
  </script>
  <!-- JavaScript
      –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <script src="https://code.jquery.com/jquery-latest.js" type="text/javascript"></script>
  <script src="assets/js/jquery-ui.js"></script>
  <script src="assets/js/jquery.ui.touch-punch.min.js"></script>
  <!-- CSS
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link rel="stylesheet" href="assets/css/normalize.css">
  <link rel="stylesheet" href="assets/css/skeleton.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link href="https://fonts.googleapis.com/css?family=Space+Mono" rel="stylesheet">
  <!-- Favicon
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link rel="shortcut icon" href="assets/images/favicon.ico" type="image/x-icon">
  <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
    <style>
    @import url('https://fonts.googleapis.com/css?family=Space+Mono');
.gallery{
  background: linear-gradient(141deg, #0f000b 0%,#1b1437 51% );
    background: -webkit-linear-gradient(141deg, #0f000b 0%,#1b1437 51%); /* For Safari 5.1 to 6.0 */
    background: -o-linear-gradient(141deg, #0f000b 0%,#1b1437 51%); /* For Opera 11.1 to 12.0 */
    background: -moz-linear-gradient(141deg, #0f000b 0%,#1b1437 51%); /* For Firefox 3.6 to 15 */
}

.inner {
  /*width: 800px;*/
  position: relative;
  margin: 0 auto;
}

header {
  width: 100%;
padding: 15px 0px 15px;
background: rgba(255,255,255,0.05);
z-index: 100;
margin-bottom: 50px;
height: 50px;
}

li {
  list-style: none;
}

nav {
  overflow: hidden;
  margin-right: 10%;
}

nav ul {
  float: right;
}

nav li {
  display: inline;
  float: left;
}

nav a {
  display: inline-block;
  color: #fff;
  text-decoration: none;
  padding: 15px;
  transition: 0.3s all;
  font-family: "freight-sans-pro", sans-serif;
  font-weight:400;
  font-size:1.125em;
  text-transform: uppercase;
}

.logo {
  float: left;
  font-family: "freight-sans-pro", sans-serif;
  font-weight:600;
  color: #fff;
  font-size: 1.875em;
  line-height: 50px;
  letter-spacing: 0.16em;
  margin-left: 10%;
}

.color-box{
  width:100px;
  height:100px;
}

    </style>
</head>

<body style="background-color:#ffffff;">
  <header id="topnav">
  <div class="inner">
    <div class="logo">INTERRUPTIONS</div>
    <nav role='navigation'>
      <ul>
        <li><a href="#">Blog</a></li>
        <li><a href="#">About</a></li>
      </ul>
    </nav>
  </div>
</header>
<section>


<?php
  $response = '';
  $searchedCode = $_GET["search-query"];
  echo $searchedCode;
   while($row=mysqli_fetch_array($result)){
     echo $row['userKey'] . '<br />';
     echo $searchedCode . '<br/></br/>';
     if ($searchedCode===$row['userKey']){
       $response = 'Welcome!';
     }
     else {
       $response = 'Invalid user code, please try again';
     }
   }
   echo $response;
?>

</section>
</body>
</html>
