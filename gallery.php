<?php
// require_once "assets/classes/DB.class.php";
// $db = new DB();

// require "../db_conn.php";
// $link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
//
// if (!$link) {
//   echo "connection error: " . mysqli_connect_error();
//
//   // redirect: send php header to redirect (with 301 code)
//   header("Location: " . URL . "error.php");
//   die();
// }
?>

<html>
<head>
  <script src="https://use.typekit.net/meo2tno.js"></script>
  <script>try{Typekit.load({ async: true });}catch(e){}</script>
    <title>Interruptions</title>
    <style>
      *{
        margin:0;
        padding:0;
      }
      body{
        /*background: linear-gradient(145deg, #1b1437 0%, #0f000b 50%);*/
        margin: 0;
        height: 100%;
        width: 100%;
        background-color: #1b1437;
        background: -moz-linear-gradient(center top, #1b1437 0%,#0f000b 100%);
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0, #1b1437),color-stop(1, #0f000b));

    background-attachment: fixed;
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
      }

      .charts{
        width: 100%;
        min-height:100vh;
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
          var dataPoints = [['X', 'Y', {'type': 'string', 'role': 'style'}]];
          for(i=0;i<1000;i++){
            dataPoints.push([randomNum(1,50), [randomNum(10,16), randomNum(0,59), randomNum(0,59)], 'point { fill-color: '+getRandomColor()+';stroke-color:'+getRandomColor()+';stroke-width:1px; }']);
          }

          var data = google.visualization.arrayToDataTable
            (dataPoints);

          var options = {
            legend: {position: 'none'},
            backgroundColor: 'none',
            //width: 1000,
            //height: 2000,
            chart: {
              title: 'Gallery'
            },
            hAxis: {title: '',
                    minValue: 0,
                    maxValue: 49,
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
                                  fontFamily: 'sans-serif'},
                    ticks: [[10, 0, 0], [11, 0, 0], [12, 0, 0], [13, 0, 0], [14, 0, 0], [15, 0, 0], [16, 0, 0],[17, 0, 0]]
                  }//Time
          };

          var chart = new google.visualization.ScatterChart(document.getElementById('chart_div'));

        chart.draw(data, options);
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
  <div id="chart_div" class="charts"></div>

</body>
</html>
