<?php

// Database configuration
$db_host = "localhost"; // Replace with your database host
$db_user = "root"; // Replace with your database username
$db_password = ""; // Replace with your database password
$db_name = "car_garage";

// Function to connect to the database
function connectToDatabase() {
    // Connect to the database
    $conn = new mysqli($GLOBALS['db_host'], $GLOBALS['db_user'], $GLOBALS['db_password'], $GLOBALS['db_name']);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

// Function to process the form submission
function processForm() {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get form data
        $first_name = $_POST["first_name"];
        $last_name = $_POST["last_name"];
        $email = $_POST["email"];
        $address = $_POST["address"];
        $phone_number = $_POST["phone_number"];
        $message = $_POST["message"];

        // Connect to the database
        $conn = connectToDatabase();

        // Insert form data into the database using prepared statements
        $sql = "INSERT INTO submissions (first_name, last_name, email, address, phone_number, message) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $first_name, $last_name, $email, $address, $phone_number, $message);
        if ($stmt->execute()) {
            // Email configuration
            $to = "example@gmail.com"; // Replace with your email address
            $subject = "New Contact Form Submission";
            $headers = "From: $email";

            // Compose email message
            $email_message = "First Name: $first_name\n";
            $email_message .= "Last Name: $last_name\n";
            $email_message .= "Email: $email\n";
            $email_message .= "Address: $address\n";
            $email_message .= "Phone Number: $phone_number\n";
            $email_message .= "Message:\n$message";

            // Send email
            mail($to, $subject, $email_message, $headers);

            // Redirect with success parameter
            header("Location: index.php?success=true");
            exit;
        } else {
            // Redirect with error parameter
            header("Location: index.php?success=false");
            exit;
        }

        // Close prepared statement and database connection
        $stmt->close();
        $conn->close();
    }
}

// Call the function to process the form submission
processForm();

?>
