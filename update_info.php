<?php
session_start();
require_once("connect.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['field']) && isset($_POST['value']) && isset($_SESSION['id'])) {
        $field = $_POST['field'];
        $value = $_POST['value'];
        $userId = $_SESSION['id'];        
        
        if($_POST['field'] == 'fname'){
        $_SESSION['name'] =  $value;
        }

        $field = mysqli_real_escape_string($conn, $field);
        $value = mysqli_real_escape_string($conn, $value);



        $sql = "UPDATE user_info SET $field = '$value' WHERE ID = '$userId'";
        $result = mysqli_query($conn, $sql);



        echo $result ? "Success" : "Error";
    } else {
        echo "Invalid request";
    }
}
?>
