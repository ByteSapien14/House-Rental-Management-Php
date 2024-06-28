<?php
session_start();
include("connection.php");

$tenantid = $_GET['t'];
$fname = $_GET['f'];
$lname = $_GET['l'];
$occ = $_GET['o'];
$gender = $_GET['g'];
$date = $_GET['d'];

if (isset($_GET['submit'])) {
    if ($tenantid != "" && $fname != "" && $lname != "") {
        // Use prepared statement
        $query = "INSERT INTO member (t_id, fname, lname, occupation, gender, dob) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);

        // Bind parameters
        mysqli_stmt_bind_param($stmt, "ssssss", $tenantid, $fname, $lname, $occ, $gender, $date);

        // Execute statement
        $success = mysqli_stmt_execute($stmt);

        if ($success) {
            echo "<script type='text/javascript'>alert('Added successfully')
                  window.location.href='tenant.php';
                  </script>";
        } else {
            echo "<script type='text/javascript'>alert('Unsuccessful')
                  window.location.href='tenant.php';
                  </script>";
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }
}
?>
