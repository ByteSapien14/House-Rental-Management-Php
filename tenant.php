<!DOCTYPE html>
<html lang="en">

<body>
<?php include 'links.php';?>

 <div class = "main">
<div class="container">
  <br><br><br><br>
  <?php
if(isset($_SESSION['ltype']) && $_SESSION['ltype'] == "owner") {
    echo "<a href='addmembers1.php' class='btn-primary'>Add Members</a> ";
}
?>
 
<?php
include("connection.php");
$query = "SELECT * FROM tenant";
$data = mysqli_query($conn, $query);

// Initialize the HTML table
echo "<table border='1' id='customers'>
        <tr>
            <th>Tenant ID</th>
            <th>First Name</th>
            <th>Email</th>
            <th>Contact</th>
            <th>Occupation</th>
        </tr>";

while ($result = mysqli_fetch_assoc($data)) {
    echo "<tr>
            <td>".$result['t_id']."</td>
            <td>".$result['fname']."</td>
            <td>".$result['email']."</td>
            <td>".$result['contact']."</td>
            <td>".$result['occupation']."</td>
          </tr>";
}

// Close the HTML table
echo "</table>";
?>

</div>
</div>
</body>
</html>
