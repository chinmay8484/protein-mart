<?php
// Database connection details
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

// Fetch inquiry data
$sql = "SELECT name, email, product, message, created_at FROM inquiries ORDER BY created_at DESC";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Inquiry Report</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h2>Inquiry Report</h2>
    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Product</th>
            <th>Message</th>
            <th>Date</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['name']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['product']}</td>
                        <td>{$row['message']}</td>
                        <td>{$row['created_at']}</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No inquiries found</td></tr>";
        }
        ?>
    </table>
</body>
</html>
<?php
$conn->close();
?>
