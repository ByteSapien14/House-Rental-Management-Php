<?php
include("connection.php");

// Query to fetch owner data
$query = "SELECT * FROM owner";
$data = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <style type="text/css">
        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
        }
        
       .card {
            border: 1px solid #ddd;
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 0 4px 82px rgba(0, 0, 0, 0.1);
            width: 300px;
            background-color: #fff;
        }

        .card-header {
            background-color: #333;
            color: #fff;
            padding-left: 0;
            padding: 10px;
            text-align: center;
         
            
        }

        .card-body {
            padding: 20px;
            flex: 1;
        }

        .card p {
            text-align: center;
            margin: 0;
            line-height: 1.5;
        }
         .profile-picture {            
            width: 80%;
            height: 150px; /* Adjust the height as needed */
            object-fit: cover;  /*Maintain aspect ratio and cover the container */
            border-bottom: 1px solid #ddd;
            margin-left: 30px; /* Add a border between image and card body */
        }
       
    </style>
</head>

<body>
    <?php include 'links.php'; ?>

    <div class="main">
        <div class="container">
            <br><br><br><br>
            <div class="card-container">
                <?php while ($result = mysqli_fetch_assoc($data)) : ?>
                    <div class="card">
                        
                        <div class="card-body">
                            <?php
                            // Check if the owner has a profile picture
                            $profilePicturePath = empty($result['profile_picture']) ? 'path/to/upload/directory/' : $result['profile_picture'];
                            ?>
                            <img src="<?php echo $profilePicturePath; ?>" alt="Profile Picture" class="profile-picture">
                            <div class="card-header">
                             <h3><?php echo $result['fname']; ?></h3>   
                            </div>
                            <p><strong>Owner ID:</strong> <?php echo $result['o_id']; ?></p>
                            <p><strong>Email:</strong> <?php echo $result['email']; ?></p>
                            <p><strong>Mobile No:</strong> <?php echo $result['contact']; ?></p>
                            <p><strong>Occupation:</strong> <?php echo $result['occupation']; ?></p>
                            <p><strong>Address:</strong> <?php echo $result['address']; ?></p>

                            <!-- Query to fetch associated house IDs -->
                            <?php
                            $ownerId = $result['o_id'];
                            $houseQuery = "SELECT id FROM house WHERE owner_id = $ownerId";
                            $houseData = mysqli_query($conn, $houseQuery);
                            ?>

                            <!-- Display associated house IDs with commas -->
                            <?php if (mysqli_num_rows($houseData) > 0) : ?>
                                <p><strong>House IDs:</strong>
                                    <?php
                                    $houseIds = [];
                                    while ($houseResult = mysqli_fetch_assoc($houseData)) {
                                        $houseIds[] = $houseResult['id'];
                                    }
                                    echo implode(', ', $houseIds);
                                    ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</body>

</html>
