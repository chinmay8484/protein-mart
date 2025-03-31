<?php
// Database connection
$servername = "localhost";
$username = "root"; // Change if different
$password = ""; // Change if you have a password
$database = "fitindia_db"; // Replace with your database name

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch records
$sql = "SELECT name, gender, address, email, pincode, card_type, card_number, exp_date FROM payments";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        h2 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h2>Payment Report</h2>

<?php
if ($result->num_rows > 0) {
    echo "<table>
            <tr>
                <th>Name</th>
                <th>Gender</th>
                <th>Address</th>
                <th>Email</th>
                <th>Pincode</th>
                <th>Card Type</th>
                <th>Card Number</th>
                <th>Expiration Date</th>
            </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . htmlspecialchars($row['name']) . "</td>
                <td>" . htmlspecialchars($row['gender']) . "</td>
                <td>" . htmlspecialchars($row['address']) . "</td>
                <td>" . htmlspecialchars($row['email']) . "</td>
                <td>" . htmlspecialchars($row['pincode']) . "</td>
                <td>" . htmlspecialchars($row['card_type']) . "</td>
                <td>" . htmlspecialchars($row['card_number']) . "</td>
                <td>" . htmlspecialchars($row['exp_date']) . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p>No payment records found.</p>";
}

$conn->close();
?>

</body>
</html>
