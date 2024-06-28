<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include("connection.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Validate and sanitize user inputs
    $ownerId = filter_input(INPUT_POST, 'o', FILTER_SANITIZE_NUMBER_INT);
    $noOfRooms = filter_input(INPUT_POST, 'n', FILTER_SANITIZE_NUMBER_INT);
    $rate = filter_input(INPUT_POST, 'ra', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $address = filter_input(INPUT_POST, 'a', 513);
    $description = filter_input(INPUT_POST, 'de', 513);

    // Check if required fields are not empty
    if ($ownerId !== null && $noOfRooms !== null && $description !== null) {
        $checkOwnerQuery = "SELECT COUNT(*) FROM owner WHERE o_id = ?";
        $stmtCheckOwner = mysqli_prepare($conn, $checkOwnerQuery);
        mysqli_stmt_bind_param($stmtCheckOwner, "i", $ownerId);
        mysqli_stmt_execute($stmtCheckOwner);
        mysqli_stmt_bind_result($stmtCheckOwner, $ownerCount);
        mysqli_stmt_fetch($stmtCheckOwner);
        mysqli_stmt_close($stmtCheckOwner);

        if ($ownerCount === 0) {
            echo "<script type='text/javascript'>alert('Error: The specified owner ID does not exist. Please provide a valid owner ID');
            window.history.back();</script>";
            exit();
        }

        // Insert into house table using prepared statement
        $query = "INSERT INTO house (owner_id, no_of_rooms, rate, address, description) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);

        // Bind parameters
        mysqli_stmt_bind_param($stmt, "iidss", $ownerId, $noOfRooms, $rate, $address, $description);

        // Execute the statement
        $success = mysqli_stmt_execute($stmt);

        // Get the auto-generated house ID
        $houseId = mysqli_insert_id($conn);

        // Close the prepared statement
        mysqli_stmt_close($stmt);

        // Handle file uploads
        if ($success && !empty($_FILES['u']['name'][0])) {
            $uploadDirectory = 'path/to/upload/directory/';

            // Create the upload directory if it doesn't exist
            if (!file_exists($uploadDirectory)) {
                mkdir($uploadDirectory, 0755, true);
            }

            // Loop through each uploaded file
            foreach ($_FILES['u']['tmp_name'] as $key => $tmpName) {
                $fileName = $_FILES['u']['name'][$key];
                $uploadPath = $uploadDirectory . $fileName;

                // Move the uploaded file to the destination directory
                if (move_uploaded_file($tmpName, $uploadPath)) {
                    // Insert into house_images table
                    $queryImages = "INSERT INTO house_images (house_id, image_data) VALUES (?, ?)";
                    $stmtImages = mysqli_prepare($conn, $queryImages);
                    mysqli_stmt_bind_param($stmtImages, "is", $houseId, $uploadPath);
                    $successImages = mysqli_stmt_execute($stmtImages);

                    // Close the prepared statement for images
                    mysqli_stmt_close($stmtImages);

                    if (!$successImages) {
                        echo "<script type='text/javascript'>alert('Error inserting image')</script>";
                        // Redirect to houses.php or another appropriate page
                        header('Location: houses.php');
                        exit();
                    }
                } else {
                    echo "<script type='text/javascript'>alert('Error uploading file')</script>";
                    // Redirect to houses.php or another appropriate page
                    header('Location: houses.php');
                    exit();
                }
            }
        }

        if ($success) {
            echo "<script type='text/javascript'>alert('Added successfully')</script>";
            // Redirect to home.php or another appropriate page
            header('Location: houses.php');
            exit();
        } else {
            echo "<script type='text/javascript'>alert('Unsuccessful')</script>";
            // Redirect to houses.php or another appropriate page
            header('Location: houses.php');
            exit();
        }
    } else {
        echo "<script type='text/javascript'>alert('Invalid data provided')</script>";
        // Redirect to houses.php or another appropriate page
        header('Location: houses.php');
        exit();
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
