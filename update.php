<?php
$id = $_POST["id"];
$name = $_POST["name"];
$surname = $_POST["surname"];
$role = $_POST["role"];
require_once("connect.php");
$sql = "UPDATE user_info SET fname='$name',lname='$surname',role = '$role' WHERE id = '$id' ";
echo $sql;
mysqli_query($conn,$sql);
mysqli_close($conn);
?>