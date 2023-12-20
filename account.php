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
    $sql = "SELECT * FROM user_info WHERE ID = '$_SESSION[id]'";
    $result = mysqli_query($conn , $sql);
    $info = mysqli_fetch_array($result , MYSQLI_ASSOC);
    ?>
    <div class="infobox">
        <h2 class="info">Information</h2>
        <div class="infoItem">
            <p class="InfoHead">Username : <span class="infoText"><?php echo $info['username'];?></span></p>
            <p class="InfoHead">First Name : <span class="infoText"><?php echo $info['fname'];?></span></p>
            <p class="InfoHead">Last Name : <span class="infoText"><?php echo $info['lname'];?></span></p>
            <p class="InfoHead">Role : <span class="infoText"><?php echo $info['role'];?></span></p>
        </div>
    </div>


    <div class="resetbox">


        <h2 class="reset">Password Reset</h2>    <?php
if(isset($_POST['submit'])) {
    $cpass = $_POST['cpass'];
    $npass = $_POST['npass'];
    $c_npass = $_POST['c-npass'];
    $npassHash = password_hash($npass , PASSWORD_DEFAULT);
    $error = array();
    
    if(password_verify($cpass , $info["password"])){
        if($npass != $c_npass){
            array_push($error , "New Passwords don't match with Re-enter New Password.");
        }
        if((strlen($npass) < 8 or strlen($npass) > 31) or (strlen($c_npass) < 8 or strlen($c_npass) > 31)){
            array_push($error , "Password must be between 9 - 30 characters long.");
        }
    } else {
        array_push($error , "Password is incorrect.");
    }

    if(count($error) > 0){
        foreach($error as $errorMsg){
            echo "<div class='alert'> $errorMsg </div>";
        }
    } else {
        if($npass == $c_npass) {
            $sqlP = "UPDATE `user_info` SET `password` = '$npassHash' WHERE `id` = $info[ID]";
            $updateP = mysqli_query($conn , $sqlP);
            if ($updateP) {
                echo "<div class='successAlt'> Password updated successfully </div>";
            } else {
                echo "<div class='alert'> Error updating password </div>";
            }
        }
    }
}
?>
        <div class="resetItem">
            <form action="account.php" method="post">
            <label for="cpass" class="resetLabel">Current password</label><br>
            <input type="password" name="cpass" placeholder="Enter your current password" required><br><br>
            <label for="npass" class="resetLabel">New Password</label><br>
            <input type="password" name="npass" placeholder="Enter your new password" required><br><br>
            <label for="c-npass" class="resetLabel">Re-enter New Password</label><br>
            <input type="password" name="c-npass" placeholder="Enter your new password" required><br><br>
            <button type="submit" name="submit" class="button">Submit</button>
            </form><br>
        </div>
    </div>

<?php require("footer.php"); ?>
</body>
</html>