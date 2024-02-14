<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Details</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .car-container {
            white-space: nowrap;
            overflow-x: auto;
            padding-bottom: 15px;
        }
        .car-card {
            display: inline-block;
            margin-right: 15px;
            max-width: 300px; /* Set a maximum width for each card */
        }
    </style>
</head>
<body>

 <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href=""><img src="images/logo.png"  height="45" width="135" alt="Logo"  class="img-fluid"/></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Services.php">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="appoinment.php">Book An Appointment</a>
                </li>
               
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contact Us</a>
                </li>
            </ul>
            <div class="d-flex">
              <a href="signin.php"><button class="btn btn-primary ms-3 bg-primary">Login</button></a> 
               <!-- <a href="signup.php"><button class="btn btn-primary ms-3 bg-primary">Sign Up</button></a>  -->
            </div>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="mb-3">
        <form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="row">
                <div class="col-md-4">
                    <label for="kmRange" class="form-label">Filter by KM Range:</label>
                    <input type="range" class="form-range" min="0" max="50000" step="5000" value="<?php echo isset($_GET['kmRange']) ? $_GET['kmRange'] : '50000'; ?>" name="kmRange" id="kmRange">
                    <p><span id="kmRangeLabel">50000</span> KM</p>
                </div>
                <div class="col-md-4">
                    <label for="priceRange" class="form-label">Filter by Price Range:</label>
                    <input type="range" class="form-range" min="0" max="100000" step="10000" value="<?php echo isset($_GET['priceRange']) ? $_GET['priceRange'] : '100000'; ?>" name="priceRange" id="priceRange">
                    <p>$<span id="priceRangeLabel">100000</span></p>
                </div>
                <div class="col-md-4">
                    <label for="modelFilter" class="form-label">Filter by Car Model:</label>
                    <select class="form-select" name="modelFilter">
                        <option value="">All</option>
                        <option value="Sedan">Sedan</option>
                        <option value="SUV">SUV</option>
                        <option value="Coupe">Coupe</option>
                        <!-- Add more options as needed -->
                    </select>
                </div>
                <div class="col-md-12 mt-3">
                    <button type="submit" class="btn btn-primary">Apply Filters</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Car Container -->
    <div class="car-container">
        <?php

         $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "car_garage";
        // Connect to the database
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Construct SQL query to fetch cars and their reviews using a JOIN operation
      $sql = "SELECT c.*, r.reviewer_name, r.rating, r.comment 
        FROM catagory c 
        LEFT JOIN reviews r ON c.ImageID = r.car_id";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '
                <div class="car-card">
                    <img src="' . $row["ImageURL"] . '" alt="Car Image" class="img-fluid mb-2">
                    <h5>' . $row["Model"] . '</h5>
                    <p><strong>Price:</strong> $' . $row["Price"] . '</p>
                    <p><strong>KM:</strong> ' . $row["KM"] . '</p>';
                
                // Display reviews for the current car
                echo '<div class="review-section">';
                echo '<h3>Reviews</h3>';
                // Check if there are reviews for the car
                if (!empty($row['reviewer_name'])) {
                    echo '<div class="review">';
                    echo '<div class="reviewer">' . $row['reviewer_name'] . '</div>';
                    echo '<div class="rating">';
                    // Display stars based on rating
                    for ($i = 0; $i < $row['rating']; $i++) {
                        echo '⭐';
                    }
                    echo '</div>';
                    echo '<div class="comment">' . $row['comment'] . '</div>';
                    echo '</div>';
                } else {
                    echo '<div class="alert alert-info" role="alert">No reviews yet.</div>';
                }
                echo '</div>'; // End of review-section
                echo '</div>'; // End of car-card
            }
        } else {
            echo '<div class="alert alert-info" role="alert">No car details found.</div>';
        }

        // Close the database connection
        $conn->close();
        ?>
    </div>
</div>


<!-- Bootstrap 5 Form for Review Submission -->



 <!-- Footer 2 - Bootstrap Brain Component -->
<footer class="footer">

  <!-- Widgets - Bootstrap Brain Component -->
  <section class=" py-4 py-md-5 py-xl-8 border-top ">
    <div class="container overflow-hidden">
      <div class="row gy-4 gy-lg-0 justify-content-xl-between">
        <div class="col-12 col-md-4 col-lg-3 col-xl-2">
          <div class="widget">
             <a class="navbar-brand" href=""><img src="images/logo.png"  alt="Logo"  class="img-fluid"/></a>
          </div>
        </div>
        <div class="col-12 col-md-4 col-lg-3 col-xl-2">
          <div class="widget">
            <h4 class="widget-title mb-4" style="color:black;">Get in Touch</h4>
            <address class="mb-4" style="color:black;">8014 Edith Blvd NE, Albuquerque, France</address>
            <p class="mb-1">
              <a class="link-dark text-decoration-none" href="tel:+15057922430">(505) 792-2430</a>
            </p>
            <p class="mb-0">
              <a class="link-dark text-decoration-none" href="mailto:your@yourdomain.com">your@yourdomain.com</a>
            </p>
          </div>
        </div>
        <div class="col-12 col-md-4 col-lg-3 col-xl-2">
          <div class="">
            <h4 class=" mb-4" style="color:black;">Learn More</h4>
            <ul class="list-unstyled">
              <li class="mb-2">
                <a href="#!" class="link-dark text-decoration-none">Services</a>
              </li>
              <li class="mb-2">
                <a href="#!" class="link-dark text-decoration-none">Testonomial</a>
              </li>
              <li class="mb-2">
                <a href="#!" class="link-dark text-decoration-none">Book An Appoinment</a>
              </li>
             
              <li class="mb-0">
                <a href="#!" class="link-dark text-decoration-none">Privacy Policy</a>
              </li>
            </ul>
          </div>
        </div>
       <div class="col-12 col-lg-3 col-xl-4">
    <div class="">
        <h4 class=" mb-4" style="color:black;">Opening Hours</h4>

        <?php
        // Fetch opening hours from the database
        $openingHoursQuery = "SELECT * FROM opening_hours";
        $result = $conn->query($openingHoursQuery);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $day = $row["day"];
                $openingTime = date("H:i", strtotime($row["opening_time"]));
                $closingTime = date("H:i", strtotime($row["closing_time"]));

                echo "<p class='mb-4' style='color:black;'>$day: $openingTime - $closingTime</p>";
            }
        } else {
            echo "<p class='mb-4' style='color:black;'>No opening hours available.</p>";
        }
        ?>
    </div>
</div>

      </div>
    </div>
  </section>

 

</footer>
<!-- Include Bootstrap JS and Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Update range slider value display
    const kmRange = document.getElementById('kmRange');
    const kmRangeLabel = document.getElementById('kmRangeLabel');
    kmRangeLabel.innerHTML = kmRange.value;

    kmRange.addEventListener('input', () => {
        kmRangeLabel.innerHTML = kmRange.value;
    });

    const priceRange = document.getElementById('priceRange');
    const priceRangeLabel = document.getElementById('priceRangeLabel');
    priceRangeLabel.innerHTML = priceRange.value;

    priceRange.addEventListener('input', () => {
        priceRangeLabel.innerHTML = priceRange.value;
    });
</script>

</body>
</html>
