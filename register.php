<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FIC | Register</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="login" id="signup">
<?php
if(isset($_POST['submit'])) {
    $role = "user";
    $username = $_POST['username'];
    $password = $_POST['pass'];
    $conPass = $_POST['c-pass'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $passwordHash = password_hash($password , PASSWORD_DEFAULT);
    $error = array();

    if($password != $conPass){
        array_push($error , "Passwords don't match with Re-enter Password.");
    }
    if(strlen($password) < 8 or strlen($password) > 31){
        array_push($error , "Password must be about 9 - 30 words long.");
    }
    if(strlen($username) > 31){
        array_push($error , "username must less than 31 words long.");
    }
    if(strlen($fname)>31 or strlen($lname)>31){
        array_push($error , "fname and lname must less than 31 words long.");
    }

    require_once "connect.php";
    $sql = "SELECT username FROM user_info WHERE username = '$username'";
    $result = mysqli_query($conn ,$sql);
    $rowCount = mysqli_num_rows($result);
    if($rowCount > 0){
        array_push($error , "Email already exist!");
    }

    if(count($error) > 0){
        foreach($error as $error){
            echo "<div class='alert'> $error </div>";
        }
    }
    else{
        $sql = "INSERT INTO user_info (`username` , `password` , `fname` , `lname` , `role`) VALUES (? , ? , ? , ? , ?) ";
        $stmt = mysqli_stmt_init($conn);
        $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
        if($prepareStmt){
            mysqli_stmt_bind_param($stmt, "sssss" , $username , $passwordHash , $fname , $lname , $role);
            mysqli_stmt_execute($stmt);
            echo "<div class='successAlt'> You are registered successfully. </div>";
        }else{
            die("somrthing went wrong.");
        }
    }
}
?>
    <div class="signFlex">
    <div class="signLogo">
            <div class="logoimg"><img src="image/bit6-logo.png" alt="bit6-logo" class="signLogoimg">
        <p class="desLogo">Empowering Growth, Nurturing Life Your Trees, Our Technology.</p></div>
        </div>
        <div class="sign">
        <div class="loginPage">
            
            <div class="regisMid">
                <h1 class="header">Sign Up</h1>
                <form action="register.php" method="post">
                    <label for="name">Name</label><br>
                    <div class="name"><input class="halfIn" type="text" name="fname" placeholder="Enter Firstname" required><input class="halfIn" type="text" name="lname" placeholder="Enter Lastname" required></div><br>
                    <label for="username">Username</label><br>
                    <input type="text" name="username" placeholder="Enter your username" required><br><br>
                    <label for="pass">Password</label><br>
                    <input type="password" name="pass" placeholder="Enter your password" required><br><br>
                    <label for="pass">Re-enter Password</label><br>
                    <input type="password" name="c-pass" placeholder="Enter your password" required>
                    <br><br><br>
                    <div class="button">
                    <button type="submit" name="submit" class="button">Sign Up</button>
                    </div><br><hr><br>
                    <div class="button">
                    <a href="login.php" class="linkButt">Sign In.</a>
                </div>       
                </form>
                </div>
        </div>
        <br>
            <div class="footer">  By clicking Sign Up, you agree to our Terms and Privacy Policy.  </div>    <br><br>
        </div>
    </div>
</body>

</html>