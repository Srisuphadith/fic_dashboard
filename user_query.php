
<?php
require_once("connect.php");
$sql = "SELECT * FROM user_info ORDER BY id DESC";
$result = mysqli_query($conn,$sql);
?>
<table class="table" style="width: 100%">
    <tr>
        <th>id</th>
        <th>Name</th>
        <th>Surname</th>
        <th>Role</th>
        <th>Action</th>
    </tr>
<?php
while($row = mysqli_fetch_assoc($result)){
    echo "<tr>";
    echo "<td>".$row["ID"]."</td><td>".$row["fname"]."</td><td>".$row["lname"]."</td><td>".$row["role"]."</td><td>";
    echo "<button class='btn btn-danger' onclick=\"phase_data(".$row["ID"].",'".$row["fname"]."','".$row["lname"]."')\">Edit</button>";
    echo "</td>";
    echo "</tr>";
}
?>
</table>
<?php
mysqli_close($conn);
?>