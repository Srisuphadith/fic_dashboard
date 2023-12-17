
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
    </tr>
<?php
while($row = mysqli_fetch_assoc($result)){
    echo "<tr>";
    echo "<td>".$row["ID"]."</td><td>".$row["fname"]."</td><td>".$row["lname"]."</td><td>".$row["role"]."</td>";
    echo "</tr>";
}
?>

<?php
if(isset($_POST['submit'])) 
{ 
    echo "success";
    header( "location: admin.php" );
}
?>
</table>

<div class="floor">
  <div class="inner-floor">

    <div class="mb-3">
         <label for="formGroupExampleInput" class="form-label">id</label>
         <input type="text" class="form-control" id="id">
    </div>
    <div class="mb-3">
         <label for="formGroupExampleInput" class="form-label">name</label>
         <input type="text" class="form-control" id="name">
    </div>
    <div class="mb-3">
        <label for="formGroupExampleInput2" class="form-label">surname</label>
        <input type="text" class="form-control" id="surname">
    </div>
    <div class="col-md-4">
        <label for="inputState" class="form-label">Role</label>
        <select id="inputState" class="form-select">
            <option selected>Choose...</option>
            <option value = "admin">Admin</option>
            <option value = "user">User</option>
            <option value = "viewer">Viewer</option>
        </select>
    </div>
    <button type="submit" id="submit" class="btn btn-primary">update</button>
  </div>

</div>