<?php
// Database connection details
$servername = "localhost"; // Change this if your database is hosted remotely
$username = "root"; // Update with your database username
$password = ""; // Update with your database password
$database = "fitindia_db"; // Replace with your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $product = trim($_POST['product']);
    $message = trim($_POST['message']);

    // Prepare SQL statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO inquiries (name, email, product, message, created_at) VALUES (?, ?, ?, ?, NOW())");
    $stmt->bind_param("ssss", $name, $email, $product, $message);

    // Execute the query
    if ($stmt->execute()) {
        echo "<script>alert('Your inquiry has been submitted successfully.'); window.location.href='index.html';</script>";
    } else {
        echo "<script>alert('Error submitting inquiry. Please try again.'); window.history.back();</script>";
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
