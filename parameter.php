<?php
$pump_max_temp = $_POST["pump_max_temp"];
$pump_min_temp = $_POST["pump_min_temp"];
$pump_max_humi = $_POST["pump_max_humi"];
$fan_min_temp = $_POST["fan_min_temp"];
$fan_min_humi = $_POST["fan_min_humi"];
require_once("connect.php");
$sql = "UPDATE parameter SET pump_max_temp = '$pump_max_temp',pump_min_temp='$pump_min_temp', pump_max_humi='$pump_max_humi',fan_min_temp='$fan_min_temp',fan_min_humi='$fan_min_humi' WHERE id = 1";
echo $sql;
mysqli_query($conn,$sql);
mysqli_close($conn);

?>