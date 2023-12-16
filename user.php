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
    <title>FIC | User</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php require("nav.php"); ?>
    <h2 class="manual">Manual Interventions​</h2>
    <div class="MornitorItem">
                <div class="mornitor"><button type="submit" name="walve" class="monitorButton"><img src="image/walve.png" alt="walve" class="monitorLogo"><p class="mornitorName">Walve : Open</p></button></div>
                <div class="mornitor"><button type="submit" name="fan" class="monitorButton"><img src="image/fan.png" alt="fan" class="monitorLogo"><p class="mornitorName">Fan : Open</p></button></div>
            </div>
    <h2 class="feedback">Feedback Submission​</h2>
</body>
</html>