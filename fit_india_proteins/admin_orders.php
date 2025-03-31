<?php
include 'db_connect.php'; // Database connection

$query = "SELECT * FROM orders";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Orders</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>

    <h2>Order Management</h2>

    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer Name</th>
                <th>Email</th>
                <th>Total Price</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="order-table">
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['customer_name']; ?></td>
                    <td><?php echo $row['customer_email']; ?></td>
                    <td>Rs. <?php echo $row['total_price']; ?></td>
                    <td>
                        <select class="order-status" data-id="<?php echo $row['id']; ?>">
                            <option value="Pending" <?php if ($row['order_status'] == 'Pending') echo 'selected'; ?>>Pending</option>
                            <option value="Processing" <?php if ($row['order_status'] == 'Processing') echo 'selected'; ?>>Processing</option>
                            <option value="Completed" <?php if ($row['order_status'] == 'Completed') echo 'selected'; ?>>Completed</option>
                            <option value="Cancelled" <?php if ($row['order_status'] == 'Cancelled') echo 'selected'; ?>>Cancelled</option>
                        </select>
                    </td>
                    <td><button onclick="deleteOrder(<?php echo $row['id']; ?>)">Delete</button></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <script src="admin.js"></script>
</body>
</html>
