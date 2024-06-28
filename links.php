<?php
session_start(); 

if (!isset($_SESSION["username"])) {
    header("Location: index.php");
    exit();
    echo "Username: " . $_SESSION['username'] . "<br>";
echo "Email: " . $_SESSION['email'] . "<br>";
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
  <link rel="stylesheet" type="text/css" href="table.css">
   <title>House Rental Management System</title>
   <style type="text/css">
    #navbar {
  background: linear-gradient(to right, #ff105f, #ffad06); 
  position: fixed;
  width: 100%;
  top: 0;
  z-index: 1000;
  padding: 10px; 
}

.navbar-nav {
  list-style: none;
  margin: 0;
  padding: 0;
  display: flex;
}

.navbar-nav li {
  margin-right: 10px; 
}

.navbar-nav li:hover {
  background-color: #3498db;
  transition: background-color 0.3s;
}

#claret1 {
  text-align: left;
  list-style: none;
}

.navbar-nav li a {
  font-size: 17px; 
  font-weight: bold; 
  text-decoration: none;
  padding: 10px;
  display: block;
  color: black;
  transition: color 0.3s; 
}

.navbar-nav li a:hover {
  color: white; 
}

.dropdown {
  position: relative;
}

.dropdown-menu {
  list-style: none;
  display: none;
  position: absolute;
  top: 100%;
  left: 0; 
  background-color: lightblue;
}

.dropdown:hover .dropdown-menu {
  display: block;
}
.dropdown-select {
    font-size: 17px;
    font-weight: bold;
    padding: 10px;
    color: black;
    background-color: linear-gradient(#ff105f, #ffad06);
 
    border-radius: 5px;
    cursor: pointer;
  }

  .dropdown-select:hover {
    background-color: #3498db;
  }
   </style>
</head>
<body>
<nav id="navbar">
    <ul class="navbar-nav">
      <li class="active"><a href="home.php">Home</a></li>
      <li><a href="houses.php">Houses </a></li>
      <li><a href="owner.php">Owners</a></li>
      
     
 <?php
if (isset($_SESSION['username']) && $_SESSION['email'] === 'tums@gmail.com') {
    echo '<li class="dropdown">
            <select class="dropdown-select" onchange="location = this.value;">
                <option value="tenant.php">Tenants</option>
                <option value="addmembers1.php">Members</option>
            </select>
          </li>';
}
?>

      <li><a href="booking.php">Bookings</a></li>
      <ul id = "claret1"> 
       <li><a href="signout.php"><span class="claret"></span> Sign Out</a></li>
      </ul>
    </ul>
</nav>
</body>
</html>
 

