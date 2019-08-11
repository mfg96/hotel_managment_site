<?php 

    $hn = 'localhost'; //hostname
    $db = 'sohailm_hotel'; //database
    $un = 'sohailm_db'; //username
    $pw = 'sohailm_db'; 

$connect=new mysqli($hn,$un,$pw,$db);

if($connect->connect_error)die($connect->connect_error);


$query="select utype,count(*) as cnt from users group by utype";
$result =$connect->query($query);


?>
<!DOCTYPE html>
<html lang="en">
<head>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {

    var data = google.visualization.arrayToDataTable([
      ['Book', 'Count'],
      <?php
      if($result->num_rows > 0){
          while($row = $result->fetch_assoc()){
            echo "['".$row['utype']."', ".$row['cnt']."],";
          }
      }
      ?>
    ]);
    
    var options = {
        title: 'User By Type',
        width: 900,
        height: 500,
    };
    
    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
    
    chart.draw(data, options);
}
</script>
</head>
<body>
    <!-- Display the pie chart -->
    <div id="piechart"></div>
</body>
</html>