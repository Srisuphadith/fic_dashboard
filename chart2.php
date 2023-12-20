<?php
 
 $dataPoints1 = array();
 $dataPoints2 = array();
 $dataPoints3 = array();
 //Best practice is to create a separate file for handling connection to database
 try{
     require_once("PDO.php");
 
     $month_sr = date("m");
     $day_sr = date("d");
     $year_sr = date("Y");
     $handle = $link->prepare("SELECT id, Temperature,Humidity,Soil_humidity,time_stamp FROM Sensor_data WHERE time_stamp LIKE '".$year_sr."-".$month_sr."-".$day_sr."%%%%%%%%%' ORDER BY id DESC"); 
     $handle->execute(); 
     $result = $handle->fetchAll(\PDO::FETCH_OBJ);
     foreach($result as $row){
         $data = explode(" ",$row->time_stamp);
         $calender = explode("-",$data[0]);
         $data2 = explode(":",$data[1]);
         array_push($dataPoints1, array("x"=>  $data2[0], "y"=> $row->Temperature));
         array_push($dataPoints2, array("x"=>  $data2[0], "y"=> $row->Humidity));
         array_push($dataPoints3, array("x"=>  $data2[0], "y"=> $row->Soil_humidity));
     }
     $link = null;
 }
 catch(\PDOException $ex){
     print($ex->getMessage());
 }
?>
<!DOCTYPE HTML>
<html>
<head>  
<script>
window.onload = function () {
var chart1 = new CanvasJS.Chart("chartContainer1", {
	animationEnabled: true,
	exportEnabled: true,
	theme: "light1", // "light1", "light2", "dark1", "dark2"
	title:{
		text: "Temperature all day : <?php echo $data[0];?>"
	},
	data: [{
		type: "scatter", //change type to bar, line, area, pie, etc  
		dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
	}]
});

var chart2 = new CanvasJS.Chart("chartContainer2", {
	animationEnabled: true,
	exportEnabled: true,
	theme: "light1", // "light1", "light2", "dark1", "dark2"
	title:{
		text: "Humidity all day : <?php echo $data[0];?>"
	},
	data: [{
		type: "scatter", //change type to bar, line, area, pie, etc  
		dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
	}]
});
var chart3 = new CanvasJS.Chart("chartContainer3", {
	animationEnabled: true,
	exportEnabled: true,
	theme: "light1", // "light1", "light2", "dark1", "dark2"
	title:{
		text: "Soil Humidity all day : <?php echo $data[0];?>"
	},
	data: [{
		type: "scatter", //change type to bar, line, area, pie, etc  
		dataPoints: <?php echo json_encode($dataPoints3, JSON_NUMERIC_CHECK); ?>
	}]
});
chart1.render();
chart2.render();
chart3.render();
 
}
</script>
</head>
<body>
<div id="chartContainer1" style="height: 470px; width: 100%;"></div> <!-- ส่วนเเสดงกราฟในhtml -->
<div id="chartContainer2" style="height: 470px; width: 100%;"></div> <!-- ส่วนเเสดงกราฟในhtml -->
<div id="chartContainer3" style="height: 470px; width: 100%;"></div> <!-- ส่วนเเสดงกราฟในhtml -->
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
</body>
</html>                              