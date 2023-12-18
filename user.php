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
    <div class="upperContent">    
        <div class="upperRight">
            <h2 class="manual">Manual Interventions​</h2>        
            <div class="manualItem">
                <?php 
                require_once("connect.php");
                $sqlD = "SELECT `pump`, `fan`, `id` FROM `status` WHERE `id` = 1";
                $resultD = mysqli_query($conn , $sqlD);
                $deviceStatus = mysqli_fetch_array($resultD , MYSQLI_ASSOC);
                ?>
                    <div class="manualInter"><button type="submit" name="walve" class="manualButton" onclick="updateStatus('pump')"><img src="image/walve.png" alt="walve" class="monitorLogo"><p class="mornitorName">Walve : <?php echo ($deviceStatus['pump'] == 1) ? "<span class='open'> open </span>" : "<span class='close'> close </span>"; ?></p></button></div>
                    <div class="manualInter"><button type="submit" name="fan" class="manualButton" onclick="updateStatus('fan')"><img src="image/fan.png" alt="fan" class="monitorLogo"><p class="mornitorName">Fan : <?php echo ($deviceStatus['fan'] == 1) ? "<span class='open'> open </span>" : "<span class='close'> close </span>"; ?></p></button></div>
            </div>
        </div>
        <div class="upperLeft">
            <h2 class="feedback">Feedback Submission​</h2>
            <?php
            if(isset($_GET['success']) && $_GET['success'] === 'true') {
                echo "<div class='successAlt'> Feedback submitted successfully! </div>";}

            if(isset($_POST['feedbackB'])){
                $feedback = $_POST['feedback'];
                $sql = "INSERT INTO feedback (`userID`, `feedback`) VALUES (?, ?)";
                $stmt = mysqli_stmt_init($conn);
                $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
                
                if ($prepareStmt) {
                    mysqli_stmt_bind_param($stmt, "is", $_SESSION['id'], $feedback);
                    mysqli_stmt_execute($stmt);
                    
                    if (mysqli_stmt_affected_rows($stmt) > 0) {
                        header("Location: user.php?success=true");
                        exit();
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
                <textarea name="feedback" rows="8" placeholder="Type your feedback"></textarea>
                <div class="buttonMid"><button type="submit" name="feedbackB" class="button"> submit </button></div>
            </form>
        </div>
    </div>
    <div class="lowerContent">
        <h2 class="sensor">Measurement Value</h2>
        <div class="sensorItem"></div>
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
</script>
</body>
</html>