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
<body id="viewerphp">
    <?php require("nav.php"); ?>
    <div class="viewerPages">
    <div class="viewerWea">
        <h2 class="weather">Weather</h2>
        <div class="weatherItem" id="my-div">
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
    let weatherFetched = false;

    if (!weatherFetched) {
        const country = 'Bangkok';
        const url = "https://api.openweathermap.org/data/2.5/weather?q=" + country + "&appid=5d05d21c66da638fb6162d37694d1a8c&units=metric";

        $.ajax({
            dataType: "json",
            url: url,
            success: function (response) {
                const temp = response["main"]["temp"];
                const humi = response["main"]["humidity"];
                const description = response["weather"][0]["description"];
                const icon = response["weather"][0]["icon"];
                const img = "https://openweathermap.org/img/wn/" + icon + "@2x.png";
                const weatherInfo = `
                <div class="weatherShow">
                    <div class="insideWeather">
                        <div class="weatherPicText">
                            <img src="${img}" alt="Weather icon">
                            <p class=InfoHead>Country : <span class="infoText">Bangkok</span></p>
                        </div>
                        <div class="weatherTextAll">
                            <p class=InfoHead>Temperature: <span class="infoText">${temp}°C</span></p>
                            <p class=InfoHead>Humidity: <span class="infoText">${humi}%</span></p>
                            <p class=InfoHead>Description: <span class="infoText">${description}</span></p>
                        </div>
                    </div>
                </div>
                `;

                $('#my-div').html(weatherInfo);
                weatherFetched = true;
            }
        });
    }
});
    </script>
    <div class="viewerFlex">
            <div class="moniItem">
                <h2 class="moni">Real-Time Monitoring</h2>
                <div class="MornitorItem">
                    <?php         
                    require_once("connect.php");
                    $sqlD = "SELECT `pump`, `fan`, `id` FROM `status` WHERE `id` = 1";
                    $resultD = mysqli_query($conn , $sqlD);
                    $deviceStatus = mysqli_fetch_array($resultD , MYSQLI_ASSOC);
                    $sqlS = "SELECT `Temperature` , `Humidity` , `Soil_humidity` , `id` FROM `Sensor_data` ORDER BY id DESC LIMIT 1";
                    $resultS = mysqli_query($conn , $sqlS);
                    $sensor = mysqli_fetch_array($resultS,MYSQLI_ASSOC);
                    ?>
                    <div class="mornitor"><img src="image/walve.png" alt="walve" class="monitorLogo"><p class="mornitorName"><span class="mornitorName">Valve : </span><span class="mornitorStatus"><?php echo ($deviceStatus['pump'] == 1) ? "<span class='open'> open </span>" : "<span class='close'> close </span>"; ?></span></p></div>
                    <div class="mornitor"><img src="image/fan.png" alt="fan" class="monitorLogo"><p class="mornitorName"><span class="mornitorName">Fan : </span><span class="mornitorStatus"><?php echo ($deviceStatus['fan'] == 1) ? "<span class='open'> open </span>" : "<span class='close'> close </span>"; ?></span></p></div>
                    <div class="mornitor"><img src="image/temp.png" alt="temperature sersor" class="monitorLogo"><p class="mornitorName"><span class="mornitorName">Temp : </span><span class="mornitorStatus"><?php echo "<span class='sensorValue'> $sensor[Temperature]</span>"; ?></span></p></div>
                    <div class="mornitor"><img src="image/air.png" alt="air humidity sensor" class="monitorLogo"><p class="mornitorName"><span class="mornitorName">Air : </span><span class="mornitorStatus"><?php echo "<span class='sensorValue'> $sensor[Humidity]</span>"; ?></span></p></div>
                    <div class="mornitor"><img src="image/soil.png" alt="soil humidity sensor" class="monitorLogo"><p class="mornitorName"><span class="mornitorName">Soil : </span><span class="mornitorStatus"><?php echo "<span class='sensorValue'> $sensor[Soil_humidity]</span>"; ?></span></p></div>
                </div>
            </div>

        <div class="viewerRight">
            <h2 class="noti">Receive Notification</h2>
            <div class="dataItem">
            </div>
        </div>
        </div>
        <div class="pastDataAll">
            <h2 class="pastData">Data from the past 7 days</h2>
            <div class="pastDataItem">
            <?php

                $sevenDaysAgo = date('Y-m-d H:i:s', strtotime('-7 days'));
                $sqlPast = "SELECT `Temperature`, `Humidity`, `Soil_humidity`, `time_stamp` FROM `Sensor_data` WHERE (`time_stamp` >= '$sevenDaysAgo')AND(`ID` % 120 = 0) ORDER BY `time_stamp` DESC";
                $pastData = mysqli_query($conn, $sqlPast);
            ?>
        <div class="tableWrapper" style="max-height: 200px; overflow-y: auto; width:100%; text-align:center;" >
        <table border="1" class="tableLower" width="90%" align="center">
            <tr>
                <th>Date</th>
                <th>Tempetature</th>
                <th>Air Humidity</th>
                <th>Soil Humidity</th>
            </tr>
            <?php while($pastS = mysqli_fetch_array($pastData)){ ?>
            <tr>
                <td class="stm"><?php echo $pastS['time_stamp']; ?></td>
                <td class="tem"><?php echo $pastS['Temperature']; ?></td>
                <td class="ahm"><?php echo $pastS['Humidity']; ?></td>
                <td class="shm"><?php echo $pastS['Soil_humidity']; ?></td>
            </tr>
            <?php } ?>
        </table>
        </div>
        </div>
            </div>
        </div>

<script>
      function updatePastData() {
        fetch('get_past_data.php')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
    const pastDataDiv = document.querySelector('.tableLower');
    pastDataDiv.innerHTML = `<tr>
        <th>Date</th>
        <th>Tempetature</th>
        <th>Air Humidity</th>
        <th>Soil Humidity</th>
    </tr>`;
data.forEach(row => {
    pastDataDiv.innerHTML += `
            <tr>
                <td class="stm">${row.time_stamp}</td>
                <td class="tem">${row.Temperature}</td>
                <td class="ahm">${row.Humidity}</td>
                <td class="shm">${row.Soil_humidity}</td>
            </tr>
        `;
    });
}).catch(error => {
                console.error('Fetch Error:', error);
            });
    }

    setInterval(updatePastData(), 120000);

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
                    let timestamp  = data.time_stamp;
                    let year = parseInt(timestamp.substring(0, 4));
                    let month = parseInt(timestamp.substring(5, 7)) - 1;
                    let day = parseInt(timestamp.substring(8, 10));
                    let hours = parseInt(timestamp.substring(11, 13));
                    let minutes = parseInt(timestamp.substring(14, 16));
                    let seconds = parseInt(timestamp.substring(17, 19));
                    let DBtime = new Date(year, month, day, hours, minutes, seconds);
                    let targetDate = new Date(DBtime.getTime() + 10 * 60000);

                    if(data.Temperature == 0 || data.Humidity == 0 || data.Soil_humidity == 0){
                        document.querySelector('.dataItem').innerHTML = "<p>Some sensor data is zero.</p>";
                    } else {
                        let timeNow = new Date();
                        console.log(timeNow);
                        console.log(targetDate);
                        if(timeNow > targetDate){
                            document.querySelector('.dataItem').innerHTML = "<div class=\"notiTextAllOff\"><p class=\"notiTextOff\"><i class=\"fas fa-exclamation-circle\"></i><span class=\"notiInside\">The farm is not responsive.</span></p><p class=\"notiDes\">Some sensors malfunction or don't work or the farm crashes.</p></div>"
                        }else{
                            document.querySelector('.dataItem').innerHTML = "<div class=\"notiTextAllOn\"><p class=\"notiTextOn\"><span class=\"notiInside\">The farm is Online.</span></p><p class=\"notiDes\">All sensors work normally.</p></div>"
                        }
                    }

                    document.querySelectorAll('span.mornitorStatus')[0].innerHTML = (data.pump == 1) ? "<span class='open'> open </span>" : "<span class='close'> close </span>";
                    document.querySelectorAll('span.mornitorStatus')[1].innerHTML = (data.fan == 1) ? "<span class='successAlt'> open </span>" : "<span class='close'> close </span>";
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
<?php require("footer.php"); ?>
</body>
</html>