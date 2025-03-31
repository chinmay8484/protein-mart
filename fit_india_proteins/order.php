<?php
include "db_connect.php"; // Include database connection

// Check if form data is received
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input data
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $quantity = intval($_POST['quantity']);
    $total_amount = floatval($_POST['total_amount']);

    // Insert order into database
    $query = "INSERT INTO orders (name, email, phone, address, product_name, quantity, total_amount, order_status, order_date) 
              VALUES ('$name', '$email', '$phone', '$address', '$product_name', $quantity, $total_amount, 'Pending', NOW())";

    if (mysqli_query($conn, $query)) {
        // Send confirmation email
        sendOrderEmail($email, $name, $product_name, $quantity, $total_amount, $address);
        echo "success";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Function to send order confirmation email
function sendOrderEmail($to, $name, $product_name, $quantity, $total_amount, $address) {
    $subject = "Order Confirmation - Fit India Protein Powder";
    $message = "
        <html>
        <head>
            <title>Order Confirmation</title>
        </head>
        <body>
            <h2>Thank you for your order, $name!</h2>
            <p>Your order details are as follows:</p>
            <table border='1' cellpadding='5' cellspacing='0'>
                <tr><td><strong>Product Name:</strong></td><td>$product_name</td></tr>
                <tr><td><strong>Quantity:</strong></td><td>$quantity</td></tr>
                <tr><td><strong>Total Amount:</strong></td><td>₹$total_amount</td></tr>
                <tr><td><strong>Delivery Address:</strong></td><td>$address</td></tr>
            </table>
            <p>We will process your order soon. Stay healthy!</p>
            <p><strong>Fit India Protein Powder Team</strong></p>
        </body>
        </html>
    ";

    // Set headers for HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: Fit India <no-reply@fitindia.com>" . "\r\n";

    // Send the email
    mail($to, $subject, $message, $headers);
}
?>
