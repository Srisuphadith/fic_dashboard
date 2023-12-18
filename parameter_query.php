<?php
require_once("connect.php");
$sql = "SELECT * FROM parameter WHERE id = 1";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
echo json_encode($row);
?>