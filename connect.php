<?php
$s = "localhost";
$u = "root";
$p = "12345678";
$d = "fic";

$conn = mysqli_connect($s,$u,$p,$d) or die("Connection Fail".mysqli_connect_error());
mysqli_set_charset($conn,"utf8");
?>