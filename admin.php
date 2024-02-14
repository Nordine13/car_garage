<?php
session_start();

// Check if the user is logged in and has the administrator role, otherwise redirect to the login page
if (!isset($_SESSION["username"]) || $_SESSION["role"] !== "administrator") {
    header("Location: signin.php");
    exit();
}

// Display a welcome message with the administrator's username
$username = $_SESSION["username"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome (Administrator)</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title text-center">Welcome, Administrator <?php echo $username; ?>!</h2>
                    <p class="text-center"><a href="logout.php" class="btn btn-danger">Logout</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
