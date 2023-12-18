<?php
require_once("connect.php");

$sqlD = "SELECT `pump`, `fan` FROM `status` WHERE `id` = 1"; 
$resultD = mysqli_query($conn, $sqlD);
$deviceStatus = mysqli_fetch_assoc($resultD);

$sqlS = "SELECT `Temperature`, `Humidity`, `Soil_humidity` FROM `sensor_data` ORDER BY id DESC LIMIT 1";
$resultS = mysqli_query($conn, $sqlS);
$sensorData = mysqli_fetch_assoc($resultS);

$statusData = [
    'pump' => $deviceStatus['pump'],
    'fan' => $deviceStatus['fan'],
    'Temperature' => $sensorData['Temperature'],
    'Humidity' => $sensorData['Humidity'],
    'Soil_humidity' => $sensorData['Soil_humidity']
];

header('Content-Type: application/json');
echo json_encode($statusData);
?>

