<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

// Fetch stats
$users_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total_users FROM users"))['total_users'];
$contactus_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total_contacts FROM contactus"))['total_contacts'];
$feedback_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total_feedback FROM feedback"))['total_feedback'];
$payments_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total_payments FROM payments"))['total_payments'];
$orders_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total_orders FROM orders"))['total_orders'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background: #f2f2f2;
            text-align: center;
        }

        h1 {
            color: #333;
        }

        .logout-btn {
            display: inline-block;
            padding: 10px 20px;
            text-decoration: none;
            background-color: #ff6347;
            color: #fff;
            border-radius: 5px;
            transition: 0.3s ease;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .logout-btn:hover {
            background-color: #e5533d;
        }

        .dashboard-container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
        }

        .reports {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .box {
            background-color: #fff;
            padding: 20px;
            width: 250px;
            text-align: center;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: 0.3s ease;
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }

        .box:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.2);
        }
    </style>
</head>
<body>

    <h1>Welcome, <?php echo $_SESSION['admin']; ?>!</h1>
    <a class="logout-btn" href="admin_logout.php">Logout</a>

    <div class="dashboard-container">
        <h2>Admin Dashboard</h2>
        <div class="reports">
            <a class="box" href="register_report.php">
                <h4>Registered Users</h4>
                <p><?php echo $users_count; ?></p>
            </a>
            
            <a class="box" href="contactreport.php">
                <h4>View Contact Messages</h4>
                <p><?php echo $contactus_count; ?></p>
            </a>
            
            <a class="box" href="feedbackreport.php">
                <h4>View Feedback</h4>
                <p><?php echo $feedback_count; ?></p>
            </a>
        
            <a class="box" href="paymentreport.php">
                <h4>View UPI Payments</h4>
                <p><?php echo $payments_count; ?></p>
            </a>

            <a class="box" href="order_report.php">
                <h4>View Orders</h4>
                <p><?php echo $orders_count; ?></p>
            </a>
        </div>
    </div>

</body>
</html>
