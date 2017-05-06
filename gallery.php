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
  <script src="http://cdn.rawgit.com/noelboss/featherlight/1.7.2/release/featherlight.min.js" type="text/javascript" charset="utf-8"></script>
  <!-- CSS
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link rel="stylesheet" href="assets/css/normalize.css">
  <link rel="stylesheet" href="assets/css/skeleton.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link href="https://fonts.googleapis.com/css?family=Space+Mono" rel="stylesheet">
  <link href="http://cdn.rawgit.com/noelboss/featherlight/1.7.2/release/featherlight.min.css" type="text/css" rel="stylesheet" />
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

  .google-visualization-tooltip {
    width: auto !important;

  }

  .chart-wrapper{
    margin-left: 4%;
  }


  section .inner {
    padding-top: 200px;
  }

  #chart_div svg g { font-family: 'Space Mono', monospace; }

  #search-form{
    float:right;
    margin-right:10%;
  }

  input[type="search"]{
    height: 36px;
    padding: 12px 50px;
    background-color: rgba(255,255,255,0.1);
    border: none;
    border-radius: 0px;
    box-shadow: none;
    box-sizing: border-box;
    width: 200px;
  }

  #search-box{
    height: 36px;
    padding: 12px 30px;
    background-image: url('assets/images/searchicon.png');
    background-position: 10px 10px;
    background-repeat: no-repeat;
    background-color: rgba(255,255,255,0.1);
    border: none;
    border-radius: 0px;
    box-shadow: none;
    box-sizing: border-box;
    width: 200px;
    font-family: "freight-sans-pro", sans-serif;
    font-weight: 200;
    font-style: normal;
    color:rgba(204,204,204,0.9);
  }

  #search-box::placeholder{
    color:rgba(204,204,204,0.3);
    font-size:1em;
    padding-left:10px;
  }

  .white-popup {
  position: relative;
  background: #FFF;
  padding: 20px;
  width: auto;
  max-width: 90vw;
  margin: 20px auto;
  height:auto;
  }

  .instructional-text{
    font-family:"freight-sans-pro", sans-serif;
    font-weight:300;
    font-size:1.3em;
    color:#f7f6f6;
    opacity: 0.75;
  }

  .instructions{
    float:left;
    margin-left:10%;
  }

  </style>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
  function getRandomColor() {
    // var letters = '012345689ABCDEF';
    // var color = '#';
    // for (var i = 0; i < 6; i++ ) {
    //     color += letters[Math.floor(Math.random() * 16)];
    // }
    // return color;
    var colors = ['#f96b6b', '#214f6b', '#b5cf13', '#f4c338', '#613363', '#f7612d', '#d62189', '#1ad323', '#10c4c4', '#ea1f38'];
    var random_color = colors[Math.floor(Math.random() * colors.length)];
    return random_color;
  }

  function randomNum(min,max){
    return Math.random() * (max - min) + min;
  }



  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart () {
    var dataPoints = [['X', 'Y', {'type': 'string', 'role': 'style'}, {'type': 'string', 'role': 'tooltip', 'p': {'html': true}}]];
    <?php
    //hh:mm:ss
    while($row=mysqli_fetch_array($result)){
      $timeStamp = (string)$row['timeStamp'];
      $hour = substr($timeStamp, -8,2);
      $minute = substr($timeStamp, -5,2);
      $second = substr($timeStamp, -2,2);

      $userPartnerKey = $row['partnerKey'];
      $partnerData = $db->getPartnerData($userPartnerKey);
      $partnerKey = parsePartnerName($partnerData, 'userKey');
      $partnerName = parsePartnerName($partnerData, 'userName');
      $partnerColor = parsePartnerName($partnerData, 'userColor');

      if($hour === '00' || $hour === '01' || $hour === '02' || $hour === '03' || $hour === '04' || $hour === '05'|| $hour === '06'|| $hour === '07'|| $hour ==='08'|| $hour ==='09'){
        $hour = '10';
      }
      else if($hour === '17' || $hour === '18' || $hour === '19' || $hour === '20' || $hour === '21' || $hour === '22'|| $hour === '23'){
        $hour = '16';
      }
      else{
        $hour = substr($timeStamp, -8,2);
      }

      $hourInt = (int)$hour;
      if($hourInt > 12){
        $hourInt = $hourInt - 12;
      }

      $image = 'assets/artpieces/myImage2iaKC2.png';
      $userName1 = $row['userName'];

      echo "dataPoints.push([randomNum(1,200), [".$hour.", ".$minute.", ".$second."], 'point {size:10; fill-color:#".$row['userColor']."; stroke-color:".$partnerColor."; stroke-width:3;}',
      createCustomHTML('".$image."')]
    );";
  }
  ?>
  function createCustomHTML(image){
    return '<a href='+image+' data-featherlight="image">Open image in lightbox</a>';
  }

  var data = google.visualization.arrayToDataTable
  (dataPoints);

  var options = {
    legend: {position: 'none'},
    'chartArea':{width:"80%",height:"90%"},
    backgroundColor: 'none',
    //width: 1000,
    'height': 1100,
    tooltip: {isHtml: true,
      trigger: 'selection'},
      chart: {
        title: 'Gallery'
      },
      hAxis: {title: '',
      minValue: 0,
      maxValue: 199,
      gridlines: {
        count: 0,
        color: 'transparent'
      },
      baselineColor: 'transparent'
    }, //Random
    vAxis: {title: '',
    format:"hh",
    direction: -1,
    gridlines: {
      color: 'transparent',
      baselineColor: 'transparent'},
      textStyle:{color: '#FFF',
      fontSize: '20px',
      fontName: 'freight-sans-pro',
      bold: true},
      ticks: [{v: [10, 0, 0], f: '10a'}, {v: [11, 0, 0], f: '11a'}, {v: [12, 0, 0], f: '12p'}, {v: [13, 0, 0], f: '1p'}, {v: [14, 0, 0], f: '2p'}, {v: [15, 0, 0], f: '3p'}, {v: [16, 0, 0], f: '4p'},{v: [17, 0, 0], f: '5p'}]
    }//Time
  };

  var chart = new google.visualization.ScatterChart(document.getElementById('chart_div'));


   chart.draw(data, options);

}


</script>
</head>

<body class="gallery">
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
  <div class='instructions'>
    <p class='instructional-text'>Click any datapoint to view an art piece or enter your code to find your own.</p>
  </div>

  <form id="search-form" action="search-result.php" method="get">
    <input type="search" id="search-box" name="search-query" placeholder="Enter User Code">
  </form>

  <section class="chart-wrapper">
    <div id="chart_div" class="charts" style="margin-top:90px;"></div>
  </section>


</body>
</html>
