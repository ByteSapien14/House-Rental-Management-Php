<!DOCTYPE html>
<html lang="en">

<body>
<?php include 'links.php';?>
  
<div class="container">
 <br><br> <br><br>

  <table border="1" id="customers">
    <tr>
      <th>Tenant ID</th>
      <th>House ID</th>
      <th>Booking Date</th>
      <th>Period</th>
      <th>Price</th>
    </tr>
<?php
include("connection.php");
$query="select * from booking";
$data=mysqli_query($conn,$query);
while($result=mysqli_fetch_assoc($data))
{
 echo "<tr><td>".$result['t_id']."</td><td>".$result['h_id']."</td><td>".$result['booking_date']."</td><td>".$result['period']."</td><td>".$result['price'];
}
echo "</table>";
?>
</div>
</body>
</html>
