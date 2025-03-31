<?php
$servername = "localhost";
$username = "root"; // Change as needed
$password = ""; // Change as needed
$database = "fitindia_db"; // Change to your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_name = $conn->real_escape_string($_POST["customer_name"]);
    $order_id = $conn->real_escape_string($_POST["order_id"]);

    // Insert order into database
    $sql = "INSERT INTO order_cancellations (customer_name, order_id) VALUES ('$customer_name', '$order_id')";
    if ($conn->query($sql) === TRUE) {
        echo "<p style='color:green;'>Order cancelled successfully! Your Order ID is: " . $conn->insert_id . "</p>";
    } else {
        echo "<p style='color:red;'>Error placing order: " . $conn->error . "</p>";
    }
}

$conn->close();
?>

