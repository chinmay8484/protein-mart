<?php
// Database connection details
$servername = "localhost"; // Your database host, usually localhost
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "fitindia_db"; // Database name

// Create connection to MySQL database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = trim($_POST['full_name']);
    $weight = floatval($_POST['weight']);
    $height = floatval($_POST['height']) / 100; // Convert cm to meters

    // Validate Inputs
    if (empty($full_name) || $weight <= 0 || $height <= 0) {
        echo "Invalid input! Please enter valid values.";
        exit;
    }

    // Calculate BMI
    $bmi = round($weight / ($height * $height), 2);

    // Determine BMI Category
    if ($bmi < 18.5) {
        $category = "Underweight";
    } elseif ($bmi >= 18.5 && $bmi < 24.9) {
        $category = "Normal weight";
    } elseif ($bmi >= 25 && $bmi < 29.9) {
        $category = "Overweight";
    } else {
        $category = "Obese";
    }

    // Insert data into database
    $stmt = $conn->prepare("INSERT INTO bmi_records (full_name, weight, height, bmi, category) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sddds", $full_name, $weight, $height, $bmi, $category);

    if ($stmt->execute()) {
        echo "BMI data saved successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close connections
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request!";
}
?>
