<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Houses</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #f0f0f0; 
        }

        .mains {
            text-align: center;
        }
        .input-field{
     font-size: 15px;
    width: 20%;
    padding:10px 0;
    margin: 5px 0;
    
    border-bottom: 1px solid #999;
    outline: none ;
    background: white;
}
        .containers {
            margin: 20px;
        }

        .card-containers {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .cards {
            border: 1px solid #ccc;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            height: 400px;
            display: flex;
            flex-direction: column;
        }

        .cards img {
            width: 100%;
            height: auto;
            display: block;
            border-bottom: 1px solid #ccc;
        }

        .card-contents {
            padding: 20px;
            background-color: #fff;
            flex: 1;
            overflow-y: auto; /* Allow content to be scrollable */
        }

        .card-contents p {
            margin: 0;
            margin-bottom: 5px;
            font-size: 20px;
            color: #333;
        }

        .btn-primary {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 20px;
        }

    </style>
</head>

<body>

    <?php include 'links.php'; ?>

    <div class="mains">
        <div class="containers">
            <br><br><br><br><br>

            <div class="search-bar">
                <label for="searchInput">Search by Address:</label>
                <input type="text" id="searchInput" placeholder="Enter address..." class = 'input-field'>
                <button onclick="searchHouses()" class = 'btn-primary'>Search</button>
            </div>

            <?php
            if (isset($_SESSION['ltype']) && $_SESSION['ltype'] == "owner")
                echo "<a href='addhouse1.php' class='btn-primary'>Add House</a>";
            ?>
              <?php
          if (isset($_SESSION['ltype']) && $_SESSION['ltype'] == "tenant")
              echo "<a href='booking1.php' class='btn-primary'>Book House</a>";
          ?>

            <!-- Card Boxes -->
            <div class="card-containers">
                <?php
                include("connection.php");
                $houseQuery = "SELECT h.*, GROUP_CONCAT(hi.image_data) AS image_data FROM house h LEFT JOIN house_images hi ON h.id = hi.house_id GROUP BY h.id";
                $houseData = mysqli_query($conn, $houseQuery);

                while ($houseResult = mysqli_fetch_assoc($houseData)) {
                    // Fetch only one image per house from house_images table
                    $imageQuery = "SELECT image_data FROM house_images WHERE house_id = {$houseResult['id']} LIMIT 1";
                    $imageData = mysqli_query($conn, $imageQuery);
                    $imageResult = mysqli_fetch_assoc($imageData);
                ?>
                    <div class="cards">
                        <?php if ($houseResult['pics'] !== null): ?>
                            <a href="house_detail.php?id=<?= $houseResult['id'] ?>">
                                <img src="data:image/jpeg;base64,<?= base64_encode($houseResult['pics']) ?>" alt="House Image">
                            </a>
                        <?php elseif ($imageResult && $imageResult['image_data'] !== null): ?>
                            <!-- Display the image from house_images with a link to house_details.php -->
                            <a href="house_detail.php?id=<?= $houseResult['id'] ?>">
                                <img src="<?= $imageResult['image_data'] ?>" alt="House Image">
                            </a>
                        <?php else: ?>
                            <!-- Handle the case where both $houseResult['pics'] and $imageResult['image_data'] are null -->
                            <!-- You can customize this section based on your requirements -->
                            <img src="path/to/placeholder/image.jpg" alt="Placeholder Image">
                        <?php endif; ?>

                        <div class="card-contents">
                            <p><strong>House No:</strong> <?= $houseResult['id'] ?></p>
                            <p><strong>Owner No:</strong> <?= $houseResult['owner_id'] ?></p>
                            <p><strong>No Of Rooms:</strong> <?= $houseResult['no_of_rooms'] ?></p>
                            <p><strong>House Type: </strong> <?= $houseResult['description'] ?></p>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
     <script src="script.js"></script>
</body>

</html>
