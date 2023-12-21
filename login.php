<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FIC | Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="login">
    <?php
    if(isset($_GET['errorMessage'])){
        echo "<div class='alert'> Login Failed !!! </div>";
    }elseif(isset($_GET['logoutSuccess'])){
        echo "<div class='successAlt'> Logout Successfully </div>";
    }
    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $password = $_POST['pass'];
        require_once("connect.php");
        $sql = "SELECT `ID` , `username` , `password` , `role` ,`fname` FROM user_info WHERE username = '$username'";
        $result = mysqli_query($conn , $sql);
        $user = mysqli_fetch_array($result , MYSQLI_ASSOC);
        if($user){
            if(password_verify($password , $user["password"])){
                session_start();
                $_SESSION['id'] = $user['ID'];
                $_SESSION['name'] = $user['fname'];
                $_SESSION['role'] = $user['role'];
                if($user['role'] == 'user'){
                    header("Location: user.php");
                    die();
                }elseif($user['role'] == 'viewer'){
                    header("Location: viewer.php");
                    die();
                }elseif($user['role'] == 'admin'){
                    header("Location: admin.php");
                    die();
                }else{
                    header("Location: reject.php");
                    die();
                }
            }else{
                echo "<div class='alert'> Password is incorrect. </div>";
            }
        }else{
            echo "<div class='alert'> Email doesn't exist. </div>";
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
            <div class="loginMid">
                <h1 class="header">Sign In</h1>
                <form action="login.php" method="post">
                    <label for="username">Username</label><br>
                    <input type="text" name="username" placeholder="Enter your username" required><br><br>
                    <label for="pass">Password</label><br>
                    <input type="password" name="pass" placeholder="Enter your password" required>
                    <br><br><br>
                    <div class="button">
                    <button type="submit" name="submit" class="button">Sign In</button>
                    </div><br><hr><br>
                    <div class="button">
                    <a href="register.php" class="linkButt">Sign Up.</a>
                </div>       
                </form>
                </div>
        </div>
        <br>
    </div>
</div>
</body>

</html>