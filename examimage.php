<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Image Gallery</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for your gallery -->
    <style>
        /* Add your custom styles here */
    </style>
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4">Image Gallery</h2>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3">
        <?php
        // Database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "car_garage";

        $conn = new mysqli($servername, $username, $password, $database);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Query to retrieve images from the database
        $sql = "SELECT * FROM services";
        $result = $conn->query($sql);

        // Display images
        while ($row = $result->fetch_assoc()) {
            $imagePath = $row['image_path'];
            echo '
                <div class="col">
                    <div class="card">
                        <img src="' . $imagePath . '" class="card-img-top" alt="Image">
                        <div class="card-body">
                            <!-- You can add additional information or buttons here if needed -->
                        </div>
                    </div>
                </div>
            ';
        }

        // Close database connection
        $conn->close();
        ?>
    </div>
</div>

<!-- Bootstrap JS and Popper.js (required for some Bootstrap components) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
