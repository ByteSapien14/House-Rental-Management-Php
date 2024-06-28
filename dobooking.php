<?php
session_start();
include("connection.php");

$tenantid = $_GET['t'];
$houseid = $_GET['h'];
$booking_date = $_GET['b'];
$period = $_GET['p'];
$price = $_GET['pr'];

if (isset($_GET['submit'])) {
    try {
        $query = "INSERT INTO booking (t_id, h_id, booking_date, period, price) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "sssss", $tenantid, $houseid, $booking_date, $period, $price);

        $success = mysqli_stmt_execute($stmt);

        if ($success) {
            echo "<script type='text/javascript'>alert('Added successfully')
                  window.location.href='booking.php';
                  </script>";
        } else {
            throw new Exception(mysqli_error($conn), mysqli_errno($conn));
        }

        mysqli_stmt_close($stmt);
    } catch (Exception $e) {
        $error_code = $e->getCode();

        if ($error_code == 1452) {
            
            $error_message = $e->getMessage();

            if (strpos($error_message, 'FOREIGN KEY (`t_id`)') !== false) {
                echo "<script type='text/javascript'>alert('Invalid tenant ID')</script>";
            } elseif (strpos($error_message, 'FOREIGN KEY (`h_id`)') !== false) {
                echo "<script type='text/javascript'>alert('Invalid house ID')</script>";
            } else {
                echo "<script type='text/javascript'>alert('Error: " . $e->getMessage() . " (Code: $error_code)')
                     window.history.back();
                      </script>";
            }
        } else {
            echo "<script type='text/javascript'>alert('Error: " . $e->getMessage() . " (Code: $error_code)')
                  window.history.back();
                  </script>";
        }
    }
}
?>
