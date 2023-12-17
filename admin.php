<?php
session_start();
if(!isset($_SESSION['name']) or !isset($_SESSION['id']) or !isset($_SESSION['role'])){
    session_destroy();
    header("Location: login.php?errorMessage=Login%20Failed");
}
if(isset($_GET['logoutWarning'])){
    session_destroy();
    header("Location: login.php?logoutSuccess=CN");
}
require_once("connect.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FIC ! Admin</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
    <?php require("nav.php"); ?>
    <div class = "ctn">
        <div class="side_bar">
        <div><button id="defaultOpen" class="tablinks" onclick="openCity(event,'System')" >System Configuration​​</button></div>
        <div><button id="b2" class="tablinks" onclick="openCity(event,'User')">User Management​​</button></div>
        <div><button id="b3" class="tablinks" onclick="openCity(event,'Troubleshooting​​​')">Troubleshooting​​​</button></div>
        
        
        
        </div>
        <div class="content" id = "System">System Configuration</div>
        <div class="content" id = "User">User Management​​</div>
        <div class="content" id = "Troubleshooting​​​">Troubleshooting​​</div>

    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="jsc.js"></script>
 

</body>
</html>