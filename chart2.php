<?php
 
$dataPoints = array();
//Best practice is to create a separate file for handling connection to database
try{
    require_once("PDO.php");
    $handle = $link->prepare('SELECT id, Temperature FROM Sensor_data ORDER BY id DESC LIMIT 20'); 
    $handle->execute(); 
    $result = $handle->fetchAll(\PDO::FETCH_OBJ);
		
    foreach($result as $row){
        array_push($dataPoints, array("x"=> $row->id, "y"=> $row->Temperature));
        echo $row->Temperature;
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
    <canvas class="chartContainer" style="width: 500px;"></canvas>
<script>
window.onload = function () {
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	exportEnabled: true,
	theme: "light1", // "light1", "light2", "dark1", "dark2"
	title:{
		text: "Temperature"
	},
	data: [{
		type: "line", //change type to bar, line, area, pie, etc  
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
</body>
</html>                              