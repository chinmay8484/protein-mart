<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "fitindia_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $pincode = $_POST['pincode'];
    $card_type = $_POST['card_type'];
    $card_number = $_POST['card_number'];
    $exp_date = $_POST['exp_date'];
    $cvv = $_POST['cvv'];
    
    // Secure inputs
    $name = $conn->real_escape_string($name);
    $gender = $conn->real_escape_string($gender);
    $address = $conn->real_escape_string($address);
    $email = $conn->real_escape_string($email);
    $pincode = $conn->real_escape_string($pincode);
    $card_type = $conn->real_escape_string($card_type);
    $card_number = $conn->real_escape_string($card_number);
    $exp_date = $conn->real_escape_string($exp_date);
    $cvv = $conn->real_escape_string($cvv);

    // Insert into database
    $sql = "INSERT INTO payments (name, gender, address, email, pincode, card_type, card_number, exp_date, cvv) 
            VALUES ('$name', '$gender', '$address', '$email', '$pincode', '$card_type', '$card_number', '$exp_date', '$cvv')";
    
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Payment Successful!'); window.location.href='index.html';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>