<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class="navPages">
    <?php if(isset($_GET['errorMessage'])){
        echo "<div class='alert'> Logout Failed !!! </div>";
    }?>
    <div class="navbar">
        <p class="userName"><?php echo strtoupper($_SESSION['role'])." : ".$_SESSION['name']; ?></p>
        <a href="logout.php" class="logout">logout</a>
</div>
</body>
</html>
