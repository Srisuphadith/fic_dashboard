<?php
require_once("connect.php");

if(isset($_GET['type'])) {
    $deviceType = $_GET['type'];

    if ($deviceType === 'pump' || $deviceType === 'fan') {
        $sqlD = "SELECT `$deviceType` FROM `status` WHERE `id` = 1";
        $resultD = mysqli_query($conn , $sqlD);
        $deviceStatus = mysqli_fetch_assoc($resultD);

        $currentStatus = $deviceStatus[$deviceType];
        $newStatus = ($currentStatus == 1) ? 0 : 1;

        $sqlUpdate = "UPDATE `status` SET `$deviceType` = $newStatus WHERE `id` = 1";
        $updateResult = mysqli_query($conn, $sqlUpdate);

        if ($updateResult) {
            echo "Status updated successfully";
        } else {
            echo "Error updating status";
        }
    } else {
        echo "Invalid device type";
    }
} else {
    echo "Device type not specified";
}
?>
