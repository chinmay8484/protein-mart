<?php
include 'db_connect.php'; // Ensure database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $order_id = $_POST['order_id'];
    $payment_method = $_POST['payment_method'];

    // Default values for optional fields
    $card_number = isset($_POST['card_number']) ? $_POST['card_number'] : null;
    $card_name = isset($_POST['card_name']) ? $_POST['card_name'] : null;
    $expiry_date = isset($_POST['expiry_date']) ? $_POST['expiry_date'] : null;
    $cvv = isset($_POST['cvv']) ? $_POST['cvv'] : null;
    $upi_id = isset($_POST['upi_id']) ? $_POST['upi_id'] : null;

    // Insert payment details into payments table
    $query = "INSERT INTO payments (order_id, payment_method, card_number, card_name, expiry_date, cvv, upi_id, status) 
              VALUES (?, ?, ?, ?, ?, ?, ?, 'Completed')";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("issssss", $order_id, $payment_method, $card_number, $card_name, $expiry_date, $cvv, $upi_id);
    $stmt->execute();

    // Update order status
    $updateQuery = "UPDATE orders SET order_status = 'Paid' WHERE id = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("i", $order_id);
    $stmt->execute();

    echo "<script>alert('Payment successful!'); window.location.href='thank_you.html';</script>";

    $stmt->close();
    $conn->close();
}
?>
