<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    
    // Database connection (adjust your credentials accordingly)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "fitindia_db";

    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Check for connection errors
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the SQL query to insert the form data into the database
    $stmt = $conn->prepare("INSERT INTO sample_requests (name, email, phone) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $phone);

    // Execute the query
    if ($stmt->execute()) {
        echo "Sample request submitted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the connection
    $stmt->close();
    $conn->close();
}
?>
