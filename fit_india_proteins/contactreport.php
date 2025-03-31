<?php
// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fitindia_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch contact messages
$sql = "SELECT id, name, email, message, submitted_at FROM contactus ORDER BY id DESC";
$result = $conn->query($sql);

// Check for query execution errors
if (!$result) {
    die("Query failed: " . $conn->error);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Contact Us Report</title>
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
    <h2>Contact Us Report</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Message</th>
            <th>Date</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . htmlspecialchars($row['id']) . "</td>
                        <td>" . htmlspecialchars($row['name']) . "</td>
                        <td>" . htmlspecialchars($row['email']) . "</td>
                        <td>" . htmlspecialchars($row['message']) . "</td>
                        <td>" . htmlspecialchars($row['submitted_at']) . "</td>
                       
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No messages found</td></tr>";
        }
        ?>
    </table>
</body>
</html>
<?php
$conn->close();
?>
