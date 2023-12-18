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
if(isset($_GET['errorMessage'])){
    echo "<div class='alert'> Logout Failed !!! </div>";
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="navbar" style="padding-left:20px;padding-right:20px;z-index: 1000;position:fixed;width:100%;">
        <p class="userName">
            <?php echo strtoupper($_SESSION['role'])." : ".$_SESSION['name']; ?>
        </p>
        <a href="logout.php" class="logout">logout</a>
    </div>
    <div class="ctn">
        <div class="side_bar">
            <div class="top_side">
                <div><button id="defaultOpen" class="tablinks" onclick="openCity(event,'System')">System
                        Configuration​​</button></div>
                <div><button id="b2" class="tablinks" onclick="openCity(event,'User')">User Management​​</button></div>
                <div><button id="b3" class="tablinks"
                        onclick="openCity(event,'Troubleshooting​​​')">Troubleshooting​​​</button></div>
            </div>
        </div>
        <div class="content" id="System">
            <div id="sys">
                <div id="sys_L">
                    
                </div>
                <div id="sys_R">

                </div>
            </div>
        </div>
        <div class="content" id="User">
            <div id="user"></div>
            <div class="floor">
                <div class="inner-floor">

                    <div class="mb-3">
                        <label for="formGroupExampleInput" class="form-label">id</label>
                        <input type="text" class="form-control" id="id" value="" disabled
                            style="background-color:rgb(169, 169, 169);">
                    </div>
                    <div class="mb-3">
                        <label for="formGroupExampleInput" class="form-label">name</label>
                        <input type="text" class="form-control" id="name">
                    </div>
                    <div class="mb-3">
                        <label for="formGroupExampleInput2" class="form-label">surname</label>
                        <input type="text" class="form-control" id="surname">
                    </div>
                    <div class="col-md-4">
                        <label for="inputState" class="form-label">Role</label>
                        <select id="inputState" class="form-select">
                            <option selected>Choose...</option>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                            <option value="viewer">Viewer</option>
                        </select>
                    </div>
                    <button type="submit" id="submit" class="btn btn-primary" style="margin-top: 20px;">update</button>
                </div>
            </div>
        </div>
        <div class="content" id="Troubleshooting​​​">
            <div id="s_ctn">
                <div id = "head">Device status</div>
                <div id="content_status"></div>
                
            </div>
            <div id="s_ctn" style="height: fit-content;">
                <div id = "head">sensor data</div>
                <div id="content_sensor" "></div>
            </div>
            <button id = "re_status" class="btn btn-primary" style="margin-left:20px;margin-top:20px;">Refresh</button>
        </div>

    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="script.js"></script>


</body>

</html>