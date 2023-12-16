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
</head>
<body>
    <?php require("nav.php"); ?>
    <h2 class="system">System Configuration​​</h2>
    <h2 class="manage">User Management​​</h2>
    <h2 class="trouble">Troubleshooting​​​</h2>
</body>
</html>