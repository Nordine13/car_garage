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
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Welcome (Administrator)</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <!-- CSS Files -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/css/light-bootstrap-dashboard.css?v=2.0.0 " rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="../assets/css/demo.css" rel="stylesheet" />
</head>

<body>
   <div class="wrapper">
        <div class="sidebar" data-image="../assets/img/sidebar-5.jpg">
            
            <div class="sidebar-wrapper">
                <div class="logo">
                    <a href="" class="simple-text">
                    <h5 class="card-title text-center">Welcome, Administrator <?php echo $username; ?>!</h2>
                       
                    </a>
                </div>
                <ul class="nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="admin.php">
                            <i class="nc-icon nc-chart-pie-35"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="./user.php">
                            <i class="nc-icon nc-circle-09"></i>
                            <p>Add Users</p>
                        </a>
                    </li>
                    <li>
                       <a class="nav-link" href="./services.php">
                            <i class="nc-icon nc-notes"></i>
                            <p>Services</p>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="./car.php">
                            <i class="nc-icon nc-paper-2"></i>
                            <p>Add Car</p>
                        </a>
                    </li>
                    <li>
                       <a class="nav-link" href="./manageopeninghour.php">
                            <i class="nc-icon nc-notes"></i>
                            <p>Manage Hour</p>
                        </a>
                    </li>
                    
                    
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg " color-on-scroll="500">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#pablo"> Dashboard </a>
                    <button href="" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navigation">
                        <ul class="nav navbar-nav mr-auto">
                            <li class="nav-item">
                                <a href="#" class="nav-link" data-toggle="dropdown">
                                    <span class="d-lg-none">Dashboard</span>
                                </a>
                            </li>                         
                        </ul>
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="logout.php">
                                    <span class="no-icon" href="">Log out</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>


<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "car_garage";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$successMessage = ""; // Initialize the success message

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $day = htmlspecialchars($_POST["day"]);
    $openingTime = htmlspecialchars($_POST["opening_time"]);
    $closingTime = htmlspecialchars($_POST["closing_time"]);

    $checkQuery = $conn->prepare("SELECT * FROM opening_hours WHERE day = ?");
    $checkQuery->bind_param("s", $day);
    $checkQuery->execute();
    $result = $checkQuery->get_result();

    if ($result->num_rows > 0) {
        $updateQuery = $conn->prepare("UPDATE opening_hours SET hours = ? WHERE day = ?");
        $hours = "$openingTime - $closingTime";
        $updateQuery->bind_param("ss", $hours, $day);

        if ($updateQuery->execute()) {
            $successMessage = "Opening hours updated successfully!";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } else {
        $insertQuery = $conn->prepare("INSERT INTO opening_hours (day, hours) VALUES (?, ?)");
        $hours = "$openingTime - $closingTime";
        $insertQuery->bind_param("ss", $day, $hours);

        if ($insertQuery->execute()) {
            $successMessage = "Opening hours inserted successfully!";
        } else {
            echo "Error inserting record: " . $conn->error;
        }
    }
    $checkQuery->close();
    
    // Close only if the variables are not null
    if (isset($updateQuery)) {
        $updateQuery->close();
    }

    if (isset($insertQuery)) {
        $insertQuery->close();
    }
}

$fetchQuery = "SELECT * FROM opening_hours";
$result = $conn->query($fetchQuery);

$openingHours = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $openingHours[$row["day"]] = $row["hours"];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Opening Hours</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Manage Opening Hours</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="mb-3">
            <label for="day" class="form-label">Day:</label>
            <select class="form-select" name="day" required>
                <option value="Mon">Monday</option>
                <option value="Tue">Tuesday</option>
                <option value="Wed">Wednesday</option>
                <option value="Thur">Thursday</option>
                <option value="Fri">Friday</option>
                <option value="Sat">Saturday</option>
                <option value="Sun">Sunday</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="opening_time" class="form-label">Opening Time:</label>
            <input type="time" class="form-control" name="opening_time" required>
        </div>
        <div class="mb-3">
            <label for="closing_time" class="form-label">Closing Time:</label>
            <input type="time" class="form-control" name="closing_time" required>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>

    <?php
    if (!empty($successMessage)) {
        echo '<div class="alert alert-success mt-3" role="alert">' . $successMessage . '</div>';
        echo '<script>
                setTimeout(function() {
                    document.querySelector(".alert").style.display = "none";
                }, 3000); // Hide the success message after 3 seconds
              </script>';
    }
    ?>
</div>

<div class="container mt-5">
    <h3>Existing Opening Hours:</h3>
    <div>
        <?php
        foreach ($openingHours as $day => $hours) {
            echo "<p>$day: $hours</p>";
        }
        ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

<?php
$conn->close();
?>
