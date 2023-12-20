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
<body id="userphp">
    <?php require("nav.php"); ?>
    <div class="upperContent">    
        <div class="upperRight">
            <h2 class="manual">Manual Interventions​</h2>        
            
                <?php 
                require_once("connect.php");
                $sqlD = "SELECT `pump`, `fan`, `id` ,`manual_state` FROM `status` WHERE `id` = 1";
                $resultD = mysqli_query($conn , $sqlD);
                $deviceStatus = mysqli_fetch_array($resultD , MYSQLI_ASSOC);
                if($deviceStatus['manual_state'] == 1){
                ?>
                <div class="manualItem">
                    <div class="manualInter"><button type="submit" name="walve" class="manualButton" onclick="updateStatus('pump')"><img src="image/walve.png" alt="walve" class="monitorLogo"><p class="mornitorName">Valve : <?php echo ($deviceStatus['pump'] == 1) ? "<span class='open'> open </span>" : "<span class='close'> close </span>"; ?></p></button></div>
                    <div class="manualInter"><button type="submit" name="fan" class="manualButton" onclick="updateStatus('fan')"><img src="image/fan.png" alt="fan" class="monitorLogo"><p class="mornitorName">Fan : <?php echo ($deviceStatus['fan'] == 1) ? "<span class='open'> open </span>" : "<span class='close'> close </span>"; ?></p></button></div>
                    <div class="manualInter"><button type="submit" name="state" class="manualButton" onclick="updateStatus('state')"><p class="mornitorName">State : <?php echo ($deviceStatus['manual_state'] == 1) ? "<span class='close'> Now Manual </span>" : "<span class='open'> Now Automatic </span>"; ?></p></button></div></div>
                    <div class="alertMN" style="bottom:0px;"><i class="fas fa-exclamation-circle"></i> Please make the state automatic. To work efficiently when you are finished using it.</div>
                <?php }else{ ?>
                    <div class="manualItem">
                    <div class="manualInter" style="text-align: right; "><button type="submit" name="state" class="manualButton" onclick="updateStatus('state')"><p class="mornitorName">State : <?php echo ($deviceStatus['manual_state'] == 1) ? "<span class='close'> Now Manual </span>" : "<span class='open'> Now Automatic </span>"; ?></p></button></div></div>
                    <div class="alertMF" style="bottom:0px;">We make every device turn off and work automatically.</div>
                <?php } ?>

        </div>
        <div class="upperLeft">
            <h2 class="feedback">Feedback Submission​</h2>
            <?php
            if(isset($_POST['feedbackB'])){
                $feedback = $_POST['feedback'];
                $sql = "INSERT INTO feedback (`userID`, `feedback`) VALUES (?, ?)";
                $stmt = mysqli_stmt_init($conn);
                $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
                
                if ($prepareStmt) {
                    mysqli_stmt_bind_param($stmt, "is", $_SESSION['id'], $feedback);
                    mysqli_stmt_execute($stmt);
                    
                    if (mysqli_stmt_affected_rows($stmt) > 0) {
                        echo "<div class='successAlt'> Feedback submitted successfully! </div>";
                    } else {
                        echo "<div class='errorAlt'> Error submitting feedback! </div>";
                    }
                } else {
                    die("Something went wrong.");
                }
                
                mysqli_stmt_close($stmt);
                
            }
            ?>

            <form action="user.php" method="post" class="feedbackform">
                <textarea name="feedback" rows="8" placeholder="Type your feedback" required></textarea>
                <div class="buttonMid"><button type="submit" name="feedbackB" class="button"> submit </button></div>
            </form>
        </div>
    </div>
    <div class="lowerContent">
        <h2 class="sensor">Measurement Value</h2>
        <div class="sensorItem">
            <?php
                $sqlS = "SELECT * FROM `Sensor_data` ORDER BY id DESC LIMIT 5";
                $resultS = mysqli_query($conn , $sqlS);
            ?>
        <table border="1" class="tableLower" width="90%" align="center">
            <tr>
                <th>Date</th>
                <th>Tempetature</th>
                <th>Air Humidity</th>
                <th>Soil Humidity</th>
            </tr>
            <?php while($sensor = mysqli_fetch_array($resultS)){ ?>
            <tr>
                <td class="stm"><?php echo $sensor['time_stamp']; ?></td>
                <td class="tem"><?php echo $sensor['Temperature']; ?></td>
                <td class="ahm"><?php echo $sensor['Humidity']; ?></td>
                <td class="shm"><?php echo $sensor['Soil_humidity']; ?></td>
            </tr>
            <?php } ?>
        </table>
            
        </div>
        <?php
 
$dataPoints = array();
//Best practice is to create a separate file for handling connection to database
try{
    require_once("PDO.php");

    $month_sr = date("m");
    $day_sr = date("d");
    $year_sr = date("Y");
    $handle = $link->prepare("SELECT id, Temperature,time_stamp FROM Sensor_data WHERE time_stamp LIKE '".$year_sr."-".$month_sr."-".$day_sr."%%%%%%%%%' ORDER BY id DESC"); 
    $handle->execute(); 
    $result = $handle->fetchAll(\PDO::FETCH_OBJ);
    foreach($result as $row){
        $data = explode(" ",$row->time_stamp);
        $calender = explode("-",$data[0]);
        $data2 = explode(":",$data[1]);
        array_push($dataPoints, array("x"=>  $data2[0], "y"=> $row->Temperature));
    }
	$link = null;
}
catch(\PDOException $ex){
    print($ex->getMessage());
}
?>
        <script>
window.onload = function () {
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	exportEnabled: true,
	theme: "light1", // "light1", "light2", "dark1", "dark2"
	title:{
		text: "Temperature day : <?php echo $data[0];?>"
	},
	data: [{
		type: "scatter", //change type to bar, line, area, pie, etc  
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
        <div id="chartContainer" style="height: 370px; width: 100%;"></div> <!-- ส่วนเเสดงกราฟในhtml -->
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
    </div>
    <script>
function updateStatus(deviceType) {
    fetch(`update_user.php?type=${deviceType}`)
        .then(response => {
            if (response.ok) {
                return response.text();
            }
            throw new Error('Network response was not ok');
        })
        .then(result => {
            console.log(result);
            location.reload();
        })
        .catch(error => {
            console.error('Fetch Error:', error);
        });
}

function updateTable() {
    fetch('update_statusUser.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            const table = document.querySelector('.tableLower');
            table.innerHTML = `<tr>
                <th>Date</th>
                <th>Tempetature</th>
                <th>Air Humidity</th>
                <th>Soil Humidity</th>
            </tr>`;
            
            data.forEach(row => {
                table.innerHTML += `
                    <tr>
                        <td class="stm">${row.time_stamp}</td>
                        <td class="tem">${row.Temperature}</td>
                        <td class="ahm">${row.Humidity}</td>
                        <td class="shm">${row.Soil_humidity}</td>
                    </tr>
                `;
            });
        })
        .catch(error => {
            console.error('Fetch Error:', error);
        });
}

setInterval(updateTable, 10000);
</script>


</script>
<?php require("footer.php"); ?>
</body>
</html>