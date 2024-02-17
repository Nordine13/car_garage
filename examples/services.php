
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "car_garage";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $service_name = htmlspecialchars($_POST["service_name"]);

    // Assuming you have an input field for the image URL
    $image_url = htmlspecialchars($_POST["image_path"]);

    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO services (service_name, image_path) VALUES (?, ?)");
    $stmt->bind_param("ss", $service_name, $image_url);

    if ($stmt->execute()) {
        echo "Service added successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
// Process form submission for updating a service
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {
    $service_id = $_POST["service_id"];
    $updated_name = htmlspecialchars($_POST["updated_name"]);

    $stmt = $conn->prepare("UPDATE services SET service_name = ? WHERE id = ?");
    $stmt->bind_param("si", $updated_name, $service_id);

    if ($stmt->execute()) {
        echo "Service updated successfully.";
    } else {
        echo "Error updating service: " . $stmt->error;
    }

    $stmt->close();
}

// Process form submission for deleting a service
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete"])) {
    $service_id = $_POST["service_id"];

    $stmt = $conn->prepare("DELETE FROM services WHERE id = ?");
    $stmt->bind_param("i", $service_id);

    if ($stmt->execute()) {
        echo "Service deleted successfully.";
    } else {
        echo "Error deleting service: " . $stmt->error;
    }

    $stmt->close();
}

// Fetch services from the database
$result = $conn->query("SELECT * FROM services");

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
   <title>Car Garage Services</title>
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
                        <a class="nav-link" href="./Testonomial.php">
                            <i class="nc-icon nc-atom"></i>
                            <p>Customer Review</p>
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
            <!-- End Navbar -->

  <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Add New Service</h4>
                                </div>
                                <div class="card-body">

                                    <form action="" method="post">
                                        <div class="row">
                                            <div class="col-md-6 pr-1">
                                                <div class="form-group">
                                                    <label for="service_name" class="form-label">Service Name</label>
                        <input type="text" class="form-control" id="service_name" name="service_name" required>
                                                </div>
                                                
                                            </div>
                                           
                                            <div class="col-md-6 pl-1">
                                                <div class="form-group">
                                                   <label for="image_url" class="form-label">Image</label>
                        <input  type="text" name="image_url" id="image_url" class="form-control" id="image" name="image" accept="image/*" required>
                                                </div>
                                            </div>
                                        </div>
                                       
                                        
                                        
                                        <button type="submit" class="btn btn-primary btn-fill pull-right">Add Service</button>
                                        
                                        <div class="clearfix"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                       
                    </div>
                
 <div class="container mt-5">
                        <h2>Services Management</h2>
                        <table class="table mt-3">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Service Name</th>
                                    <th>Image</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $result->fetch_assoc()) : ?>
                                    <tr>
                                        <td><?php echo $row['id']; ?></td>
                                        <td><?php echo $row['service_name']; ?></td>
                                        <td><img src="<?php echo $row['image_path']; ?>" alt="<?php echo $row['service_name']; ?>" width="50" height="50"></td>
                                        <td>
                                            <form method="post" class="d-inline">
                                                <input type="hidden" name="service_id" value="<?php echo $row['id']; ?>">
                                                <input type="text" name="updated_name" placeholder="New Name" required>
                                                <button type="submit" name="update" class="btn btn-primary btn-sm">Update</button>
                                            </form>

                                            <form method="post" class="d-inline">
                                                <input type="hidden" name="service_id" value="<?php echo $row['id']; ?>">
                                                <button type="submit" name="delete" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>

            

        <!-- Display Error Messages -->
        <?php
        if (isset($_GET['error'])) {
            $error = $_GET['error'];
            echo '<div class="alert alert-danger mt-3">' . $error . '</div>';
        }
        ?>

        <!-- Display Services -->
        <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php
        // Fetch services from the database
        $result = $conn->query("SELECT * FROM services");

        // Display services
        while ($row = $result->fetch_assoc()) {
            echo '<div class="col">
                    <div class="card">
                        <img src="' . $row['image_path'] . '" class="card-img-top img-fluid" alt="' . $row['service_name'] . '">
                        <div class="card-body">
                            <h5 class="card-title">' . $row['service_name'] . '</h5>
                        </div>
                    </div>
                </div>';
        }

        $conn->close();
        ?>
    </div>
    

                    
                </div>
            </div>
            
        </div>
    </div>

   
            
</body>
<!--   Core JS Files   -->
<script src="../assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="../assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="../assets/js/core/bootstrap.min.js" type="text/javascript"></script>
<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="../assets/js/plugins/bootstrap-switch.js"></script>
<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!--  Chartist Plugin  -->
<script src="../assets/js/plugins/chartist.min.js"></script>
<!--  Notifications Plugin    -->
<script src="../assets/js/plugins/bootstrap-notify.js"></script>
<!-- Control Center for Light Bootstrap Dashboard: scripts for the example pages etc -->
<script src="../assets/js/light-bootstrap-dashboard.js?v=2.0.0 " type="text/javascript"></script>
<!-- Light Bootstrap Dashboard DEMO methods, don't include it in your project! -->
<script src="../assets/js/demo.js"></script>

</html>
