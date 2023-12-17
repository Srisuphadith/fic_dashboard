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
    <!-- <h2 class="system">System Configuration​​</h2>
    <h2 class="manage">User Management​​</h2>
    <h2 class="trouble">Troubleshooting​​​</h2> -->
    <div class = "ctn">
        <div class="side_bar">
        <div><button id="defaultOpen" class="tablinks" onclick="openCity(event,'System')" >System Configuration​​</button></div>
        <div><button class="tablinks" onclick="openCity(event,'User')">User Management​​</button></div>
        <div><button class="tablinks" onclick="openCity(event,'Troubleshooting​​​')">Troubleshooting​​​</button></div>
        
        
        
        </div>
        <div class="content" id = "System">System Configuration</div>
        <div class="content" id = "User">User Management​​</div>
        <div class="content" id = "Troubleshooting​​​">Troubleshooting​​</div>

    </div>
    <script src="jsc.js"></script>
</body>
</html>