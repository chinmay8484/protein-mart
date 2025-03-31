<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $cart = json_decode($_POST['cart'], true);

    // Calculate total amount
    $total_amount = 0;
    foreach ($cart as $item) {
        $total_amount += $item['total'];
    }

    // Insert order into `orders` table
    $query = "INSERT INTO orders (name, email, address, total_amount) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssd", $name, $email, $address, $total_amount);
    $stmt->execute();
    $order_id = $stmt->insert_id;
    $stmt->close();

    // Insert order items into `order_items` table
    $query = "INSERT INTO order_items (order_id, product_name, price, quantity, total) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    foreach ($cart as $item) {
        $stmt->bind_param("isdid", $order_id, $item['name'], $item['price'], $item['quantity'], $item['total']);
        $stmt->execute();
    }
    $stmt->close();
    $conn->close();

    // Clear cart and redirect
    echo "<script>
            alert('Order Placed Successfully!');
            localStorage.removeItem('cart');
            window.location.href = 'order_success.php';
          </script>";
}
?>
