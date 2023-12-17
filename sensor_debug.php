<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
<body>
<?php
require_once("connect.php");
$sql = "SELECT * FROM Sensor_data";
$result = mysqli_query($conn,$sql);
?>
<table class="table">
    <tr>
        <th>id</th>
        <th>Temperature</th>
        <th>Humidity</th>
        <th>Soil_humidity</th>
        <th>time_stamp</th>
    </tr>
<?php
while($row = mysqli_fetch_assoc($result)){
    echo "<tr>";
    echo "<td>".$row["id"]."</td><td>".$row["Temperature"]."</td><td>".$row["Humidity"]."</td><td>".$row["Soil_humidity"]."</td><td>".$row["time_stamp"]."</td>";
    echo "</tr>";
}

?>

</table>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
<?php
 mysqli_close($conn);
?>