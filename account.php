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
    <title>FIC | Account</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body id="accountphp">
    <?php 
    require("nav.php"); 
    require_once("connect.php");
    ?>


    <div class="infobox">
        <h2 class="info">Information</h2>
        <div class="infoItem">
            
        </div>
    </div>


    <div class="resetbox">
        <h2 class="reset">Password Reset</h2>
        <div class="resetItem">
            
        </div>
    </div>

<?php require("footer.php"); ?>
</body>
</html>