<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

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

// Fetch feedback data
$sql = "SELECT name, email, feedback FROM feedback";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Feedback Report</title>
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
    <h2>Feedback Report</h2>
    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Feedback</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['name']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['feedback']}</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No feedback available</td></tr>";
        }
        ?>
    </table>
</body>
</html>
<?php
$conn->close();
?>
