<?php
session_start();
include 'db_connect.php';

// Check if the admin is logged in
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

// Fetch cancelled orders
$sql = "SELECT o.id, u.name AS customer_name, o.order_status, o.created_at 
        FROM orders o
        JOIN users u ON o.user_id = u.id
        WHERE o.order_status = 'Cancelled'
        ORDER BY o.created_at DESC";

$result = $conn->query($sql);
if (!$result) {
    die("Error fetching data: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cancelled Order Report</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/SheetJS/0.18.5/xlsx.full.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        h2 {
            color: #333;
        }
        .btn-container {
            margin-bottom: 15px;
        }
        button {
            margin-right: 10px;
            padding: 8px 15px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <h2>Cancelled Order Report</h2>

    <div class="btn-container">
        <button onclick="downloadPDF()">Download PDF</button>
        <button onclick="downloadExcel()">Download Excel</button>
        <button onclick="window.print()">Print Report</button>
    </div>

    <table id="orderTable">
        <tr>
            <th>Order ID</th>
            <th>Customer Name</th>
            <th>Order Status</th>
            <th>Created At</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . htmlspecialchars($row["id"]) . "</td>
                        <td>" . htmlspecialchars($row["customer_name"]) . "</td>
                        <td>" . htmlspecialchars($row["order_status"]) . "</td>
                        <td>" . htmlspecialchars($row["created_at"]) . "</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No cancelled orders found</td></tr>";
        }
        ?>
    </table>

    <script>
        function downloadPDF() {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();

            doc.text("Cancelled Order Report", 10, 10);
            let table = document.getElementById("orderTable");
            let rows = table.rows;
            let data = [];

            for (let i = 0; i < rows.length; i++) {
                let row = [], cols = rows[i].cells;
                for (let j = 0; j < cols.length; j++) {
                    row.push(cols[j].innerText);
                }
                data.push(row);
            }

            doc.autoTable({
                head: [data[0]],
                body: data.slice(1),
            });

            doc.save("Cancelled_Order_Report.pdf");
        }

        function downloadExcel() {
            let table = document.getElementById("orderTable");
            let ws = XLSX.utils.table_to_sheet(table);
            let wb = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(wb, ws, "Cancelled Orders");
            XLSX.writeFile(wb, "Cancelled_Order_Report.xlsx");
        }
    </script>

</body>
</html>

<?php
$conn->close();
?>
