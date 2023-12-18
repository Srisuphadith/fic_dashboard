
<?php
require_once("connect.php");
$sql = "SELECT * FROM Sensor_data ORDER BY id DESC LIMIT 5";
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

<?php
 mysqli_close($conn);
?>