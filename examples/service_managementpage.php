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

// Process form submission for updating service
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

// Process form submission for deleting service
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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Services Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</head>

<body>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-e8IjZY7fZYVfejsqPKNqV6b3ZVjsrjlK5C8/jfcyBjRH9fPzW1g23uVZypXpi8X+" crossorigin="anonymous"></script>
</body>

</html>

<?php
$conn->close();
?>
