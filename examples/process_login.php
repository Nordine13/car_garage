<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

session_start();

// Replace these database credentials with your own
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Perform SQL query to check user credentials and role
    $sql = "SELECT * FROM user_credentials WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Verify the password using password_verify if hashed
        if ($user["password"] == $password) {
            $_SESSION["username"] = $user["username"];
            $_SESSION["role"] = $user["role"];

            // Redirect based on user role
            if ($user["role"] == "administrator") {
                header("Location: admin/examples/admin.php");


              
                exit();
            } elseif ($user["role"] == "employee") {
                header("Location: employee.php");
                exit();
            }
        }
    }

    // Authentication failed
    $_SESSION['login_error'] = 'Invalid username or password.';
    header("Location: signin.php");
    exit();
}

$conn->close();
?>
