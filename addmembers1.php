<!DOCTYPE html>
<html lang="en">
<body>
<?php 
include 'links.php';
?>
<div class = "main">  
<center>
<div class="card" style="width: 45rem;border-radius: 35px;background-color:#f0f5f5;margin-top:150px">
<br>
 <div class="card-body">
<h1 class="card-title" style="text-align:center"><B>Add Member</B></h1><br>
<form name="Form2" action="addmembers.php" method="get" enctype="multipart/form-data">

<table class="tab">
	<tr>
		<td><b>Tenant ID: </b></td>
		<td> <input type=number name="t" value="" size=25></td>
	</tr>
	<tr>
		<td><b>First Name: </b></td>
		<td> <input type=textbox name="f" value="" size=25></td>
	</tr>
	<tr>
		<td><b>Last Name: </b></td>
		<td> <input type=textbox name="l" value="" size=25></td>
	</tr>
	<tr>
	
		<td><b>Occupation: </b></td>
		<td> <input type=textbox name="o" value="" size=25></td>
	</tr>
	<tr>
		<td><b>Gender: </b></td>
		<td> <input type=textbox name="g" value="" size=25></td>
	</tr>
	<tr>
		<td><b>Date of birth: </b></td>
		<td> <input type=date name="d" value="" size=25></td>
	</tr>
</table>
<br><br>
<input type=submit value="Add" class="btn btn-danger" name="submit">
</form><br>
</div>
</div>
</center>
</div>
</body>

</html>
