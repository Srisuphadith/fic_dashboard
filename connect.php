<?php
$s = "localhost";
$u = "root";
$p = "ๅ/_ภถุึค";
$d = "FIC";

$conn = mysqli_connect($s,$u,$p,$d) or die("Connection Fail".mysqli_connect_error());
mysqli_set_charset($conn,"utf8");
?>