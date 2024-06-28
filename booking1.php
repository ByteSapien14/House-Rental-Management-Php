<!DOCTYPE html>
<html lang="en">

<body>
<?php include 'links.php';?>
<div class = "main">
<center>
<div class="card" style=" width: 43rem;height: 30rem;border-radius: 35px;background-color:#f0f5f5; margin-top: 180px;">
<br>
 <div class="card-body">
<h1 class="card-title" style="text-align:center"><B>Book House</B></h1><br>
<form name="Form2" action="dobooking.php" method="get" enctype="multipart/form-data">

<table class ="tab">
	<tr  >
		<td><b>Tenant ID: </b></td>
		<td> <input type=number name="t" value="" size=25></td>
	</tr>
	<tr>
		<td><b>House ID: </b></td>
		<td> <input type=number name="h" value="" size=25></td>
	</tr>
	<tr>
		<td><b>Booking Date: </b></td>
		<td> <input type=date name="b" value="" size=25></td>
	</tr>
	<tr>
		<td><b>Period: </b></td>
		<td> <input type=number name="p" value="" size=25></td>
	</tr>
	<tr>
		<td><b>Price: </b></td>
		<td> <input type=number name="pr" value="" size=25></td>
	</tr>
	
</table>
<br><br>
<input type=submit value="Add" class="btn-primary" name="submit">
</form><br>
</div>
</div>
</div>
</body>

</html>
