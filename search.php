<?php
include("connection.php");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$address = isset($_GET['address']) ? $_GET['address'] : '';
$sql = "SELECT h.*, GROUP_CONCAT(hi.image_data) AS image_data, o.contact
        FROM house h
        LEFT JOIN house_images hi ON h.id = hi.house_id
        LEFT JOIN owner o ON h.owner_id = o.o_id
        WHERE h.address LIKE '%$address%'
        GROUP BY h.id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Houses Search Results</title>
    <style>
        .search-result {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            height: 300px;
            display: flex;
            flex-direction: column;  
             justify-content: center;
            background-color: #fff;
        }

        .house-image {
            max-width: 100%;
            height: auto;

        }
    </style>
</head>
<body>

    <?php include 'links.php'; ?>

    <div class="mains">
        <div class="container">
            <br><br><br><br><br>

            <div class="search-results">

                <?php

  
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $cardId = 'card_' . $row['id'];

                        echo '<div class="search-result" id="' . $cardId . '">';
 
                        
                        if ($row['image_data']) {
                            echo '<a href="house_detail.php?id=' . $row['id'] . '">';
                            echo '<img class="house-image" src="data:image/jpeg;base64,' . base64_encode($row['image_data']) . '" alt="House Image">';
                            echo '</a>';
                        } else {
                            echo '<a href="house_detail.php?id=' . $row['id'] . '">';
                            echo '<img class="house-image" src="path/to/placeholder/image.jpg" alt="Placeholder Image">';
                            echo '</a>';
                        }

                        echo '<p><strong>Contact Number:</strong> ' . $row['contact'] . '</p>';

                        
                        echo '<p><strong>House No:</strong> ' . $row['id'] . '</p>';
                        echo '<p><strong>Location:</strong> ' . $row['address'] . '</p>';
                        echo '<p><strong>No Of Rooms:</strong> ' . $row['no_of_rooms'] . '</p>';
                        echo '<p><strong>House Type:</strong> ' . $row['description'] . '</p>';

                        echo '</div>';
                    }
                } else {
                    echo '<p>No results found.</p>';
                }
                ?>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>

<?php
$conn->close();
?>
