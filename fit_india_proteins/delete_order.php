<?php
include 'db_connect.php';

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['order_id'])) {
    echo json_encode(["success" => false, "message" => "Invalid request"]);
    exit;
}

$order_id = $data['order_id'];

// Delete order items first (because of foreign key constraint)
$query1 = "DELETE FROM order_items WHERE order_id = ?";
$stmt1 = $conn->prepare($query1);
$stmt1->bind_param("i", $order_id);
$stmt1->execute();

// Now delete the order
$query2 = "DELETE FROM orders WHERE id = ?";
$stmt2 = $conn->prepare($query2);
$stmt2->bind_param("i", $order_id);
$result = $stmt2->execute();

if ($result) {
    echo json_encode(["success" => true, "message" => "Order deleted"]);
} else {
    echo json_encode(["success" => false, "message" => "Failed to delete order"]);
}

$stmt1->close();
$stmt2->close();
$conn->close();
?>
