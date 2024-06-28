<?php
if (isset($_POST['register'])) {
    include 'connection.php';

    $username = sanitizeInput($_POST['username']);
    $email = sanitizeInput($_POST['email']);
    $password = sanitizeInput($_POST['password']);
    $contact = sanitizeInput($_POST['contact']);
    $occupation = sanitizeInput($_POST['occupation']);
    $address = sanitizeInput($_POST['address']);
    $role = sanitizeInput($_POST['role']); // Assuming 'user_role' is the field for selecting role

    // Validate and sanitize input data
    if (empty($username)) {
    echo "Registration failed. Please enter a username.";
    exit();
} elseif (empty($email)) {
    echo "Registration failed. Please enter an email address.";
    exit();
} elseif (empty($password)) {
    echo "Registration failed. Please enter a password.";
    exit();
} elseif (empty($contact)) {
    echo "Registration failed. Please enter a contact number.";
    exit();
} elseif (empty($occupation)) {
    echo "Registration failed. Please enter an occupation.";
    exit();
} elseif (empty($address)) {
    echo "Registration failed. Please enter an address.";
    exit();
} elseif (empty($role)) {
    echo "Registration failed. Please select a role.";
    exit();
}


    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Registration failed. Invalid email format.";
        exit();
    }

    if (!preg_match('/^(?=.*[A-Z])(?=.*\d).{8,}$/', $password)) {
        echo "<script type='text/javascript'>alert('Password must be at least 8 characters long and contain at least One Uppercase Letter and One Digit');
        window.history.back();
      </script>";
       
        exit();
    }

    $check_sql = "SELECT * FROM users WHERE username = '$username'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        echo "Registration failed. Username already exists.";
    } else {
        if ($role == 'owner') {
            // Handle profile picture upload
            $profilePictureName = $_FILES['profile_picture']['name'];
            $profilePictureTmpName = $_FILES['profile_picture']['tmp_name'];
            $profilePictureSize = $_FILES['profile_picture']['size'];
            $profilePictureError = $_FILES['profile_picture']['error'];

            if ($profilePictureError === 0) {
                $profilePictureDestination = 'path/to/upload/directory/' . $profilePictureName;
                move_uploaded_file($profilePictureTmpName, $profilePictureDestination);
            } else {
                echo "Error uploading profile picture.";
                exit();
            }

            // Insert data into the owner table
            $insert_sql_owner = "INSERT INTO owner (fname, email, pwd, contact, occupation, address, profile_picture) VALUES ('$username','$email','$password','$contact','$occupation','$address', '$profilePictureDestination')";
            if ($conn->query($insert_sql_owner) === TRUE) {
                echo "Owner registration successful!";
                header('Location: home.php');
            } else {
                echo "Error: " . $insert_sql_owner . "<br>" . $conn->error;
            }
        } elseif ($role == 'tenant') {
            $insert_sql_tenant = "INSERT INTO tenant (fname, email, pwd, contact, occupation, address) VALUES ('$username','$email','$password','$contact','$occupation','$address')";
            if ($conn->query($insert_sql_tenant) === TRUE) {
                echo "<script type='text/javascript'>alert('Tenant Registration Successful')
            window.location.href='home.php';
            </script>";

            } else {
                echo "Error: " . $insert_sql_tenant . "<br>" . $conn->error;
            }
        } else {
            echo "Invalid user role selected.";
        }
    }

    $conn->close();
}

function sanitizeInput($input) {
    global $conn;
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $conn->real_escape_string($input);
}
?>
