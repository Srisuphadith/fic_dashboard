<?php
require_once("connect.php");

$sevenDaysAgo = date('Y-m-d H:i:s', strtotime('-1 hours'));
$sqlPast = "SELECT `Temperature`, `Humidity`, `Soil_humidity`, `time_stamp` FROM `Sensor_data` WHERE `time_stamp` >= '$sevenDaysAgo' ORDER BY `time_stamp` DESC";
$result = mysqli_query($conn, $sqlPast);

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        $rows = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        echo json_encode($rows);
    } else {
        echo json_encode(array('message' => 'No data found'));
    }
} else {
    echo json_encode(array('error' => mysqli_error($conn)));
}

mysqli_close($conn);
?>
