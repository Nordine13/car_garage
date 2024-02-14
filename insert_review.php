<?php
// Database connection
  $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "car_garage";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("INSERT INTO reviews (car_id, reviewer_name, rating, comment) VALUES (?, ?, ?, ?)");
$stmt->bind_param("isss", $car_id, $reviewer_name, $rating, $comment);

// Set parameters and execute
$car_id = $_POST['car_id'];
$reviewer_name = $_POST['reviewer_name'];
$rating = $_POST['rating'];
$comment = $_POST['comment'];
$stmt->execute();

// Check if the review was successfully inserted
if ($stmt->affected_rows > 0) {
    $success_message = "Review submitted successfully";
} else {
    $error_message = "Failed to submit review. Please try again.";
}

// Close statement and database connection
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Submission</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <?php if (isset($success_message)): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $success_message; ?>
            </div>
        <?php elseif (isset($error_message)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>
        <a href="javascript:history.go(-1)" class="btn btn-primary">Back</a>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
