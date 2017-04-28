<?php
  require "assets/inc/page_start.inc.php";
?>

<html>
<head>
  <script src="https://use.typekit.net/meo2tno.js"></script>
  <script>try{Typekit.load({ async: true });}catch(e){}</script>
    <title>Interruptions</title>
    <style>
      /**{
        margin:0;
        padding:0;
      }
      body{
        background: linear-gradient(141deg, #1b1437 0%, #0f000b 50%);
      }
      nav{
        background: rgba(255,255,255,0.1);
        margin: 0;
        overflow: hidden;
        padding: 20px;
        display: -webkit-flex;
        display:flex;
      }

      nav h1{
        font-family: "freight-sans-pro", sans-serif;
        font-weight:bold;
        color:#ffffff;
        letter-spacing: 3px;
        text-transform: uppercase;
        display: -webkit-flex;
        display:flex;
        justify-content: flex-start;
      }

      nav ul{
        display: -webkit-flex;
        display:flex;
        list-style-type:none;
        padding:0;
        justify-content:flex-end;
      }

      nav li a{
        font-family: "freight-sans-pro", sans-serif;
        font-weight: light;
        color: #ffffff;
        font-size: 1em;
        text-decoration: none;
        text-transform: uppercase;
      }

      nav li{
        padding: 0px 10px 0px 10px;
        margin: 0px 20px 0px 20px;
      }*/


    </style>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
    google.charts.load('current', {'packages':['scatter']});
     google.charts.setOnLoadCallback(drawChart);

     function drawChart () {

       var data = new google.visualization.DataTable();
       data.addColumn('number', 'Random');
       data.addColumn('timeofday', 'Time of Day');

       data.addRows([
        [Math.floor(Math.random() * 50) + 1  , [8, 30, 45]],
        [Math.floor(Math.random() * 50) + 1  , [9, 0, 0]],
        [Math.floor(Math.random() * 50) + 1  , [10, 0, 0, 0]],
        [Math.floor(Math.random() * 50) + 1  , [10, 45, 0, 0]],
        [Math.floor(Math.random() * 50) + 1  , [11, 0, 0, 0]],
        [Math.floor(Math.random() * 50) + 1  , [12, 15, 45, 0]],
        [Math.floor(Math.random() * 50) + 1  , [13, 0, 0, 0]],
        [Math.floor(Math.random() * 50) + 1  , [14, 30, 0, 0]],
        [Math.floor(Math.random() * 50) + 1  , [15, 12, 0, 0]],
        [Math.floor(Math.random() * 50) + 1  , [16, 45, 0]],
        [Math.floor(Math.random() * 50) + 1  , [16, 59, 0]]
      ]);

       var options = {
         chartArea: {
           left: 0,
           height: 900,
           width: 1100
    },
         width: 1200,
         height: 1000,
         chart: {
           title: '',
           subtitle: ''
         },
         hAxis: {title: ''},
         vAxis: {title: 'Time'}
       };

       var chart = new google.charts.Scatter(document.getElementById('scatterchart_material'));

       chart.draw(data, google.charts.Scatter.convertOptions(options));
     }
    </script>
</head>

<body>
  <nav>
    <h1>Interruptions</h1>
    <ul>
      <li><a href="#">About</a></li>
      <li><a href="#">Blog</a></li>
    </ul>
  </nav>
  <div id="scatterchart_material"></div>

</body>
</html>
