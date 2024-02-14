<?php

// Assuming you have a file with your database connection details
include('include.php');

$page_url = "cardetail.php";

// Create a connection to the database
$db_host = "localhost"; // Replace with your database host
$db_user = "root"; // Replace with your database username
$db_password = ""; // Replace with your database password
$db_name = "car_garage";

$conn = new mysqli($db_host, $db_user,$db_password , $db_name);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Your SQL query and image retrieval code here...
$sql = "SELECT * FROM services";
$result = $conn->query($sql);

// Check if the query was successful
if ($result === false) {
    die("Error executing query: " . $conn->error);
}

// Process the results, e.g., fetch the data in a loop
while ($row = $result->fetch_assoc()) {
    // Your code to display or process the images
}


// Close the database connection
$conn->close();
?>

   
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Garage</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<style>
        .hidden {
            display: none;
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
        }
    </style>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="index.php"><img src="images/logo.png"  alt="Logo"  class="img-fluid"/></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav mx-auto">
               
                <li class="nav-item">
                    <a class="nav-link" href="#services">Services</a>
                </li>
                 <li class="nav-item">
                    <a class="nav-link" href="#car">Cars</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#appoinment">Book An Appointment</a>
                </li>
               
                <li class="nav-item">
                    <a class="nav-link" href="#testo">Testonomial</a>
                </li>
            </ul>
            <div class="d-flex">
              <a href="signin.php"><button class="btn btn-primary ms-3 bg-primary">Login</button></a> 
               <!-- <a href="signup.php"><button class="btn btn-primary ms-3 bg-primary">Sign Up</button></a>  -->
            </div>
        </div>
    </div>
</nav>
<br>

    <section id="home" class="text-center">
        <div class="container">

            <img src="https://platform.cstatic-images.com/ad-creative/1de6a677-e71a-4a4f-9c28-351c584989b7/20240105_7480_carshero-template-20230609_GTB.png?w=1600&q=60" alt="Snow" style="width:100%;">
               <a href=""><div class="text-block">
                    <h4>SOLD CAR DEALERS</h4>
                    <p>FIND YOUR BEST CAR</p>
                </div></a> 
        </div>
    </section>
    <br>
<div id="services" class="font container-fluid scrollToSection">
        <h2 class="hover-div">Services</h2>        
    </div>
    <br>
    <div id="service" class="" >
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

        
       // Display services
        echo '<div class="container">
        <div class="row row-cols-1 row-cols-md-3 g-4">';
while ($row = $result->fetch_assoc()) {
    echo '<div class="col">
            <div class="card">
                <img src="' . $row['image_path'] . '" class="card-img-top img-fluid" alt="' . $row['service_name'] . '" width="180" height="120">
                <div class="card-body">
                    <h5 class="card-title">' . $row['service_name'] . '</h5>
                </div>
            </div>
           

        </div>';
}
echo '</div></div>';


        // Close database connection
        $conn->close();
        ?>
    </div>
</div>


    <br>

    <section id="car Section_image" class="scrollToSection">
    <div class="font container-fluid">
        <h2 class="hover-div">Popular Catagories</h2>        
    </div>
   <div class="container mt-5">
    <?php
    // Assuming you have a database connection established, replace these values with your actual database credentials
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

    // Retrieve data from the Images table
    $sql = "SELECT * FROM catagory";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    echo '<div class="row">';
    while ($row = $result->fetch_assoc()) {
        echo '

        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="' . $row["ImageURL"] . '" alt="Thumbnail Image" class="card-img-top">
                <div class="card-body">
                    <p class="card-text">
                  
                        <strong>Price:</strong> $' . $row["Price"] . '<br>
                        <strong>Model:</strong> ' . $row["Model"] . '<br>
                        <strong>KM:</strong> ' . $row["KM"] . '
                    </p>
                </div>
                 <a href="' . $page_url . '">Detail</a>
                  
           
            </div>
        </div>';
    }
    echo '</div>';
} else {
    echo '<div class="alert alert-info" role="alert">No data found.</div>';
}

    // Close the database connection
    $conn->close();
    ?>
</div>

  
</section> 

 

<br>

<!-- Testonomial -->
<section id="Section_image testo" class="scrollToSection">
    <div class="font container-fluid">
        <h2 class="hover-div">Customer Testonomial</h2>        
    </div>


<!-- Carousel wrapper -->
<!-- Carousel wrapper -->
<div id="carouselMultiItemExample" class="carousel slide carousel-dark text-center" data-mdb-ride="carousel">
  <!-- Controls -->
  <div class="d-flex justify-content-center mb-4">
    <button class="carousel-control-prev position-relative" type="button"
      data-mdb-target="#carouselMultiItemExample" data-mdb-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next position-relative" type="button"
      data-mdb-target="#carouselMultiItemExample" data-mdb-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
  <!-- Inner -->
  <div class="carousel-inner py-4">
    <!-- Single item -->
    <div class="carousel-item active">
      <div class="container">
        <div class="row">
          <div class="col-lg-4">
           
            <h5 class="mb-3" style="color:black;">Anna Deynah</h5>
            <p style="color:black">UX Designer</p>
            <p class="text-muted">
              <i class="fas fa-quote-left pe-2"></i>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod eos id
              officiis hic tenetur quae quaerat ad velit ab hic tenetur.
            </p>
            <ul class="list-unstyled d-flex justify-content-center text-warning mb-0">
              <li><i class="fas fa-star fa-sm"></i></li>
              <li><i class="fas fa-star fa-sm"></i></li>
              <li><i class="fas fa-star fa-sm"></i></li>
              <li><i class="fas fa-star fa-sm"></i></li>
              <li><i class="fas fa-star fa-sm"></i></li>
            </ul>
          </div>

          <div class="col-lg-4 d-none d-lg-block">
           
            <h5 class="mb-3" style="color:black;">John Doe</h5>
            <p style="color:black">Web Developer</p>
            <p class="text-muted">
              <i class="fas fa-quote-left pe-2"></i>
              Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis
              suscipit laboriosam, nisi ut aliquid commodi.
            </p>
            <ul class="list-unstyled d-flex justify-content-center text-warning mb-0">
              <li><i class="fas fa-star fa-sm"></i></li>
              <li><i class="fas fa-star fa-sm"></i></li>
              <li><i class="fas fa-star fa-sm"></i></li>
              <li><i class="fas fa-star fa-sm"></i></li>
              <li>
                <i class="fas fa-star-half-alt fa-sm"></i>
              </li>
            </ul>
          </div>

          <div class="col-lg-4 d-none d-lg-block">
          
            <h5 class="mb-3" style="color:black;">Maria Kate</h5>
            <p style="color:black">Photographer</p>
            <p class="text-muted">
              <i class="fas fa-quote-left pe-2"></i>
              At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis
              praesentium voluptatum deleniti atque corrupti.
            </p>
            <ul class="list-unstyled d-flex justify-content-center text-warning mb-0">
              <li><i class="fas fa-star fa-sm"></i></li>
              <li><i class="fas fa-star fa-sm"></i></li>
              <li><i class="fas fa-star fa-sm"></i></li>
              <li><i class="fas fa-star fa-sm"></i></li>
              <li><i class="far fa-star fa-sm"></i></li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <!-- Single item -->
    <div class="carousel-item">
      <div class="container">
        <div class="row">
          <div class="col-lg-4">
           
            <h5 class="mb-3" style="color:black;">John Doe</h5>
            <p>UX Designer</p>
            <p class="text-muted">
              <i class="fas fa-quote-left pe-2"></i>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod eos id
              officiis hic tenetur quae quaerat ad velit ab hic tenetur.
            </p>
            <ul class="list-unstyled d-flex justify-content-center text-warning mb-0">
              <li><i class="fas fa-star fa-sm"></i></li>
              <li><i class="fas fa-star fa-sm"></i></li>
              <li><i class="fas fa-star fa-sm"></i></li>
              <li><i class="fas fa-star fa-sm"></i></li>
              <li><i class="fas fa-star fa-sm"></i></li>
            </ul>
          </div>

          <div class="col-lg-4 d-none d-lg-block">
           
            <h5 class="mb-3" style="color:black;">Alex Rey</h5>
            <p>Web Developer</p>
            <p class="text-muted">
              <i class="fas fa-quote-left pe-2"></i>
              Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis
              suscipit laboriosam, nisi ut aliquid commodi.
            </p>
            <ul class="list-unstyled d-flex justify-content-center text-warning mb-0">
              <li><i class="fas fa-star fa-sm"></i></li>
              <li><i class="fas fa-star fa-sm"></i></li>
              <li><i class="fas fa-star fa-sm"></i></li>
              <li><i class="fas fa-star fa-sm"></i></li>
              <li>
                <i class="fas fa-star-half-alt fa-sm"></i>
              </li>
            </ul>
          </div>

          <div class="col-lg-4 d-none d-lg-block">
           
            <h5 class="mb-3" style="color:black;">Maria Kate</h5>
            <p>Photographer</p>
            <p class="text-muted">
              <i class="fas fa-quote-left pe-2"></i>
              At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis
              praesentium voluptatum deleniti atque corrupti.
            </p>
            <ul class="list-unstyled d-flex justify-content-center text-warning mb-0">
              <li><i class="fas fa-star fa-sm"></i></li>
              <li><i class="fas fa-star fa-sm"></i></li>
              <li><i class="fas fa-star fa-sm"></i></li>
              <li><i class="fas fa-star fa-sm"></i></li>
              <li><i class="far fa-star fa-sm"></i></li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <!-- Single item -->
    <div class="carousel-item">
      <div class="container">
        <div class="row">
          <div class="col-lg-4">
            <img class="rounded-circle shadow-1-strong mb-4"
              src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(6).webp" alt="avatar"
              style="width: 150px;" />
            <h5 class="mb-3" style="color:black;">Anna Deynah</h5>
            <p>UX Designer</p>
            <p class="text-muted">
              <i class="fas fa-quote-left pe-2"></i>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod eos id
              officiis hic tenetur quae quaerat ad velit ab hic tenetur.
            </p>
            <ul class="list-unstyled d-flex justify-content-center text-warning mb-0">
              <li><i class="fas fa-star fa-sm"></i></li>
              <li><i class="fas fa-star fa-sm"></i></li>
              <li><i class="fas fa-star fa-sm"></i></li>
              <li><i class="fas fa-star fa-sm"></i></li>
              <li><i class="fas fa-star fa-sm"></i></li>
            </ul>
          </div>

          <div class="col-lg-4 d-none d-lg-block">
           
            <h5 class="mb-3" style="color:black;">John Doe</h5>
            <p>Web Developer</p>
            <p class="text-muted">
              <i class="fas fa-quote-left pe-2"></i>
              Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis
              suscipit laboriosam, nisi ut aliquid commodi.
            </p>
            <ul class="list-unstyled d-flex justify-content-center text-warning mb-0">
              <li><i class="fas fa-star fa-sm"></i></li>
              <li><i class="fas fa-star fa-sm"></i></li>
              <li><i class="fas fa-star fa-sm"></i></li>
              <li><i class="fas fa-star fa-sm"></i></li>
              <li>
                <i class="fas fa-star-half-alt fa-sm"></i>
              </li>
            </ul>
          </div>

          <div class="col-lg-4 d-none d-lg-block">
            <img class="rounded-circle shadow-1-strong mb-4"
              src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(7).webp" alt="avatar"
              style="width: 150px;" />
            <h5 class="mb-3" style="color:black;">Maria Kate</h5>
            <p>Photographer</p>
            <p class="text-muted">
              <i class="fas fa-quote-left pe-2"></i>
              At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis
              praesentium voluptatum deleniti atque corrupti.
            </p>
            <ul class="list-unstyled d-flex justify-content-center text-warning mb-0">
              <li><i class="fas fa-star fa-sm"></i></li>
              <li><i class="fas fa-star fa-sm"></i></li>
              <li><i class="fas fa-star fa-sm"></i></li>
              <li><i class="fas fa-star fa-sm"></i></li>
              <li><i class="far fa-star fa-sm"></i></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Inner -->
</div>
<!-- Carousel wrapper -->
</section>
 <section id="appoinment" class="py-3 py-md-5 scrollToSection" >
 <div class="container mt-5">
        <?php
        // Display success message if it exists
        if (isset($_GET['success']) && $_GET['success'] == 'true') {
            echo '<div class="alert alert-success" role="alert">Message sent successfully!</div>';
        }

        // Display error message if it exists
        if (isset($_GET['success']) && $_GET['success'] == 'false') {
            echo '<div class="alert alert-danger" role="alert">Error sending message. Please try again.</div>';
        }
        ?>
      </div>

      
  <div class="container">
    <div class="row justify-content-md-center">
      <div class="col-12 col-md-10 col-lg-8 col-xl-7 col-xxl-6">
        <h2 class="mb-4 display-5 text-center hover-div" style="color:black;">Book An Appoinment</h2>
        <p class="text-secondary mb-5 text-center">Do you have any questions? Please do not hesitate to contact us directly. Our team will come back to you within a matter of hours to help you</p>
        <hr class="w-50 mx-auto mb-5 mb-xl-9 border-dark-subtle">
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row justify-content-lg-center">
      <div class="col-12 col-lg-9">
        <div class="bg-light border rounded shadow-sm overflow-hidden">

          <form action="include.php" method="post">
            <div class="row gy-4 gy-xl-5 p-4 p-xl-5">
              <div class="col-6">
                <label for="fullname" class="form-label" style="color:black;">First Name <span class="text-danger">*</span></label>
               <input type="text" class="form-control" name="first_name" placeholder="First Name" required>
              </div>
               <div class="col-6">
                <label for="fullname" class="form-label" style="color:black;">Second Name <span class="text-danger">*</span></label>
                 <input type="text" class="form-control" name="last_name" placeholder="Last Name" required>
              </div>
              <div class="col-12 col-md-6">
                <label for="email" class="form-label" style="color:black;">Email <span class="text-danger">*</span></label>
                <div class="input-group">
                  <span class="input-group-text">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                      <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z" />
                    </svg>
                  </span>
                 <input type="email" class="form-control" id="email" name="email" placeholder="Example@gmail.com" required>
                </div>
              </div>
              <div class="col-12 col-md-6">
                <label for="phone" class="form-label" style="color:black;">Phone Number</label>
                <div class="input-group">
                  <span class="input-group-text">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
                      <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z" />
                    </svg>
                  </span>
                  <input type="text" class="form-control" name="phone_number" placeholder="Phone Number" required>
                </div>
              </div>
              <div class="col-12">
                <label for="phone" class="form-label" style="color:black;">Address</label>
                <div class="input-group">
                  <span class="input-group-text">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24" viewBox="0 0 24 24">
            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-13h2v6h-2zm0 8h2v2h-2z"/>
        </svg>
                  </span>
                  <input type="text" class="form-control" name="address" placeholder="Your Address" required>
                </div>
              </div>
              <div class="col-12">
                <label for="message" class="form-label" style="color:black;">Message <span class="text-danger">*</span></label>
                <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
              </div>
              <div class="col-12">
                <div class="d-grid">
                  <button class="btn btn-primary btn-lg" type="submit">Submit</button>
                </div>
              </div>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</section>
    
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
        <?php
// Assuming you have a database connection established

// Your database credentials
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

// Fetch data from the opening_hours table
$sql = "SELECT day, hours FROM opening_hours";
$result = $conn->query($sql);

// Check if there are results
if ($result->num_rows > 0) {
    echo '<div class="col-12 col-lg-3 col-xl-4">
            <div class="">
              <h4 class="mb-4" style="color:black;">Opening Hours</h4>
              <p class="mb-4" style="color:black;">';

    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo $row["day"] . ": " . $row["hours"] . "<br>";
    }

    echo '</p>
          </div>
        </div>';
} else {
    echo "No opening hours data available";
}

// Close connection
$conn->close();
?>
      </div>
    </div>
  </section>

 

</footer>



<script>
        document.querySelectorAll('.scrollToSection').forEach(function(link) {
            link.addEventListener('click', function(event) {
                event.preventDefault();

                var targetId = this.getAttribute('href').substring(1);
                var targetElement = document.getElementById(targetId);

                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop,
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  
</body>
</html>
