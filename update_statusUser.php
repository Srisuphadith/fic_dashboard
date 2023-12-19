<?php
require_once("connect.php");

$sql = "SELECT * FROM `Sensor_data` ORDER BY id DESC LIMIT 5";
$result = mysqli_query($conn, $sql);

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
