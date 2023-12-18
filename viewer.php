<?php
session_start();
if(!isset($_SESSION['name']) or !isset($_SESSION['id']) or !isset($_SESSION['role'])){
    session_destroy();
    header("Location: login.php?errorMessage=CN");
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
    <title>FIC | Viewer</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php require("nav.php"); ?>
    <div class="viewerFlex">
        <div class="viewerLeft">
            <div class="moniItem">
                <h2 class="moni">Real-Time Monitoring</h2>
                <div class="MornitorItem">
                    <?php         
                    require_once("connect.php");
                    $sqlD = "SELECT `pump`, `fan`, `id` FROM `status` WHERE `id` = 1";
                    $resultD = mysqli_query($conn , $sqlD);
                    $deviceStatus = mysqli_fetch_array($resultD , MYSQLI_ASSOC);
                    $sqlS = "SELECT `Temperature` , `Humidity` , `Soil_humidity` , `id` FROM `sensor_data` ORDER BY id DESC LIMIT 1";
                    $resultS = mysqli_query($conn , $sqlS);
                    $sensor = mysqli_fetch_array($resultS,MYSQLI_ASSOC)
                    ?>
                    <div class="mornitor"><img src="image/walve.png" alt="walve" class="monitorLogo"><p class="mornitorName"><span class="mornitorName">Walve : </span><span class="mornitorStatus"><?php echo ($deviceStatus['pump'] == 1) ? "<span class='open'> open </span>" : "<span class='close'> close </span>"; ?></span></p></div>
                    <div class="mornitor"><img src="image/fan.png" alt="fan" class="monitorLogo"><p class="mornitorName"><span class="mornitorName">Fan : </span><span class="mornitorStatus"><?php echo ($deviceStatus['fan'] == 1) ? "<span class='open'> open </span>" : "<span class='close'> close </span>"; ?></span></p></div>
                    <div class="mornitor"><img src="image/temp.png" alt="temperature sersor" class="monitorLogo"><p class="mornitorName"><span class="mornitorName">Temp : </span><span class="mornitorStatus"><?php echo "<span class='sensorValue'> $sensor[Temperature]</span>"; ?></span></p></div>
                    <div class="mornitor"><img src="image/air.png" alt="air humidity sensor" class="monitorLogo"><p class="mornitorName"><span class="mornitorName">Air : </span><span class="mornitorStatus"><?php echo "<span class='sensorValue'> $sensor[Humidity]</span>"; ?></span></p></div>
                    <div class="mornitor"><img src="image/soil.png" alt="soil humidity sensor" class="monitorLogo"><p class="mornitorName"><span class="mornitorName">Soil : </span><span class="mornitorStatus"><?php echo "<span class='sensorValue'> $sensor[Soil_humidity]</span>"; ?></span></p></div>
                </div>
            </div>
            <div class="dataAll"><h2 class="data">Data Analysis</h2><div class="dataItem"></div></div>
        </div>
        <div class="viewerRight">
            <h2 class="noti">Receive Notification</h2><div class="notiItem">

            </div>
        </div>
    </div>

<script>
    function updateMonitorStatus() {
        setInterval(function() {
            fetch('update_status.php')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    document.querySelectorAll('span.mornitorStatus')[0].innerHTML = (data.pump == 1) ? "<span class='open'> open </span>" : "<span class='close'> close </span>";
                    document.querySelectorAll('span.mornitorStatus')[1].innerHTML = (data.fan == 1) ? "<span class='open'> open </span>" : "<span class='close'> close </span>";
                    document.querySelectorAll('span.mornitorStatus')[2].innerHTML = "<span class=\"sensorValue\">"+data.Temperature+"</span>";
                    document.querySelectorAll('span.mornitorStatus')[3].innerHTML = "<span class=\"sensorValue\">"+data.Humidity+"</span>";
                    document.querySelectorAll('span.mornitorStatus')[4].innerHTML = "<span class=\"sensorValue\">"+data.Soil_humidity+"</span>";
                    
                })
                .catch(error => {
                    console.error('Fetch Error:', error);
                });
        }, 1000);
    }

    updateMonitorStatus();
</script>

</body>
</html>