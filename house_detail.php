<?php
include("connection.php");
include("links.php");

// Check if the 'id' parameter is set in the URL
if (isset($_GET['id'])) {
    $houseId = $_GET['id'];

    // Fetch house details from the database based on the house ID
    $query_house = "SELECT * FROM house WHERE id = ?";
    $stmt_house = mysqli_prepare($conn, $query_house);
    mysqli_stmt_bind_param($stmt_house, "i", $houseId);
    mysqli_stmt_execute($stmt_house);
    $result_house = mysqli_stmt_get_result($stmt_house);

    if ($row_house = mysqli_fetch_assoc($result_house)) {
        // Display house details
        $ownerId = $row_house['owner_id'];
        $noOfRooms = $row_house['no_of_rooms'];
        $address = $row_house['address'];
        $description = $row_house['description'];
        $rate = $row_house['rate'];
         $pics = isset($row_house['pics']) ? base64_encode($row_house['pics']): null;
    } else {
        // House not found
        echo "House not found!";
        exit();
    }

    // Fetch images for the house from the house_images table
    $query_images = "SELECT * FROM house_images WHERE house_id = ?";
    $stmt_images = mysqli_prepare($conn, $query_images);
    mysqli_stmt_bind_param($stmt_images, "i", $houseId);
    mysqli_stmt_execute($stmt_images);
    $result_images = mysqli_stmt_get_result($stmt_images);
} else {
    // 'id' parameter not set
    echo "Invalid request!";
    exit();
}

// Close the prepared statements
mysqli_stmt_close($stmt_house);
mysqli_stmt_close($stmt_images);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>House Details</title>
    <style>
       

        .container {
            max-width: 100% auto;
            margin: 8%;
            object-position: center;
        }

        .house-detail {
          position: absolute;
          top: 40%;
          left: 50%;
          transform: translate(-50%, -50%);
            display: flex;
            width: 1000px;
            justify-content: space-between;
            align-items: center;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        .house-info {
            flex: 1;
            padding: 20px;
            text-align: left;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;            
        }

        p {
            margin: 0 0 10px;
        }

        .house-images {
          
            max-width: 500px;
            height: auto;
            display: flex;
            flex-wrap: wrap;
            margin-top: 10px;
            margin-left: 10px;
        }

        .house-images img {
            max-width: 100%;
            margin-right: 10px;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="house-detail">
            <img src="data:image/jpeg;base64,<?= $pics ?>" alt="" class="house-image">

            <?php if ($result_images) : ?>
            <div class="house-images">
                <?php while ($row_image = mysqli_fetch_assoc($result_images)) : ?>
                    <img src="<?= $row_image['image_data'] ?>" alt="House Image">
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
            <div class="house-info">

              <h2>House Details</h2>
                <p><strong>House No:</strong> <?= $houseId ?></p>
                <p><strong>Owner No:</strong> <?= $ownerId ?></p>
                <p><strong>No Of Rooms:</strong> <?= $noOfRooms ?></p>
                <p><strong>Address:</strong> <?= $address ?></p>
                <p><strong>Description:</strong> <?= $description ?></p>
                <p><strong>Rate for Rent:</strong> <?= $rate ?></p>
            </div>

        
        </div>
    </div>
</body>

</html>
