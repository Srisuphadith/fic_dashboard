<?php
session_start();
session_destroy();

if(!isset($_SESSION['name']) and !isset($_SESSION['id']) and !isset($_SESSION['role'])){
    header("Location: login.php?logoutSuccess=CN");
}else{
    if($_SESSION['role'] == "admin"){
    header("Location: admin.php?logoutWarning=CN");
}elseif($_SESSION['role'] == "user"){
    header("Location: user.php?logoutWarning=CN");
}elseif($_SESSION['role'] == "viewer"){
    header("Location: viewer.php?logoutWarning=CN");
}
}
?>
