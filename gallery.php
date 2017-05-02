<?php
require_once "assets/classes/DB.class.php";
$db = new DB();
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
        function getRandomColor() {
        var letters = '012345689ABCDEF';
        var color = '#';
        for (var i = 0; i < 6; i++ ) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }
      google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart () {
          //var rand = Math.floor((Math.random() * 50) + 1);
        //var data = new google.visualization.DataTable();
         //   foreach (point in db){
         //   var data += [Math.floor((Math.random() * 50) + 1), [parsedTime], 'point {fill-color:'+pointColor+'}']
         // }

          var data = google.visualization.arrayToDataTable
            ([['X', 'Y', {'type': 'string', 'role': 'style'}],
              [Math.floor((Math.random() * 50) + 1), [10, 01, 0], 'point { fill-color: '+getRandomColor()+'; }'],
              [Math.floor((Math.random() * 50) + 1), [11, 30, 0], 'point { fill-color: '+getRandomColor()+'; }'],
              [Math.floor((Math.random() * 50) + 1), [16, 59, 0], 'point { fill-color: '+getRandomColor()+'; }'],
              [Math.floor((Math.random() * 50) + 1), [13, 23, 0], 'point { fill-color: '+getRandomColor()+'; }'],
              [Math.floor((Math.random() * 50) + 1), [14, 45, 0], 'point { fill-color: '+getRandomColor()+'; }'],
              [Math.floor((Math.random() * 50) + 1), [15, 40, 0], 'point { fill-color: '+getRandomColor()+'; }'],
              [Math.floor((Math.random() * 50) + 1), [16, 34, 0], 'point { fill-color: '+getRandomColor()+'; }'],
              [Math.floor((Math.random() * 50) + 1), [12, 12, 0], 'point { fill-color: '+getRandomColor()+'; }']
        ]);
          // data.addColumn('number', 'Random');
          // data.addColumn('timeofday', 'Time of Day');
          // // data.addColumn( {'type': 'string', 'role': 'style'} );
          // // data.addColumn('number', 'X-axis');
          // // data.addColumn('number', 'A data');
          // // data.addColumn({'type': 'string', 'role': 'style'});
          // // data.addColumn('number', 'B data');
          // // data.addColumn({'type': 'string', 'role': 'style'});
          // //data.addColumn( {'type': 'string', 'role': 'style'} );
          // //time: [hh, mm, ss]
          // data.addRows([
          //   [10, [10, 01, 0]],
          //   [30, [11, 30, 0]],
          //   [Math.floor((Math.random() * 50) + 1), [16, 59, 0]],
          //   [Math.floor((Math.random() * 50) + 1), [13, 23, 0]],
          //   [Math.floor((Math.random() * 50) + 1), [14, 45, 0]],
          //   [Math.floor((Math.random() * 50) + 1), [15, 40, 0]],
          //   [Math.floor((Math.random() * 50) + 1), [16, 34, 0]],
          //   [Math.floor((Math.random() * 50) + 1), [12, 12, 0]]
          // ]);


          var options = {
            legend: {position: 'none'},
            width: 800,
            height: 500,
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
            vAxis: {title: '', format:"hh", direction: -1, gridlines: {
                color: 'transparent',
                baselineColor: 'transparent'}}//Time
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
  <div id="chart_div" style="width: 900px; height: 500px;"></div>

</body>
</html>
