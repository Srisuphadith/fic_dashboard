<?php
require_once("connect.php");
$sql = "SELECT * FROM status WHERE id = 1";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
?>
<div style = "display:flex;"><div>pump : </div><div><?php if ($row["pump"] == 0){echo "Close";}else{echo "Open";};?></div></div>
<div style = "display:flex;"><div>fan : </div><div><?php if ($row["fan"] == 0){echo "Close";}else{echo "Open";};?></div></div>
<?php
$sql = "SELECT device_name,status FROM device WHERE id = 1";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
?>
<div style = "display:flex;"><div><?php echo $row["device_name"];?>: </div><div><?php if ($row["status"] == 0){echo "Offline";}else{echo "Online";};?></div></div>