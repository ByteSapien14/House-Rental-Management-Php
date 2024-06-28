
<!DOCTYPE html>
<html lang="en">
<body>
<?php
 include 'links.php';
 $role = isset($_SESSION['ltype']) ? $_SESSION['ltype'] : null;

if ($role === "owner") {
    header('location:houses.php');
    exit();
}
?>
<div class = "main">  
<div class="container">
  <br><br><br>
  <table border="1" id="customers">
    <tr>
      <th>Tenant ID</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Gender</th>
      <th>Date Of Birth</th>
      <th>Occupation</th>
    </tr>
<?php
include("connection.php");
$query="select * from member";
$data=mysqli_query($conn,$query);
while($result=mysqli_fetch_assoc($data))
{
 echo "<tr><td>".$result['t_id']."</td><td>".$result['First_name']."</td><td>".$result['Last_name']."</td><td>".$result['gender']."</td><td>".$result['dob']."</td><td>".$result['occupation'];
}
echo "</table>";
?>
</div>
</div>
</body>
</html>
