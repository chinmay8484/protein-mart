<?php
include "db_connect.php"; // Ensure this file contains correct database connection

// Fetch all orders from the database
$query = "SELECT * FROM orders";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Database query failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Report</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/SheetJS/0.18.5/xlsx.full.min.js"></script>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; margin: 20px; }
        table { width: 80%; margin: 20px auto; border-collapse: collapse; }
        th, td { padding: 10px; border: 1px solid black; }
        th { background-color: #f2f2f2; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        .btn-container { margin-bottom: 15px; }
        .btn { padding: 10px 15px; margin: 5px; cursor: pointer; background-color: #007bff; color: white; border: none; border-radius: 5px; }
        .btn:hover { background-color: #0056b3; }
    </style>
</head>
<body>

    <h2>Order Report</h2>

    <div class="btn-container">
        <button class="btn" onclick="window.print()">Print</button>
        <button class="btn" onclick="downloadPDF()">Download PDF</button>
        <button class="btn" onclick="downloadExcel()">Download Excel</button>
    </div>

    <table id="order-table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Total Amount</th>
                <th>Order Status</th>
                <th>Order Date</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row['id']); ?></td>
                <td><?php echo htmlspecialchars($row['name']); ?></td>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
                <td>₹<?php echo htmlspecialchars($row['total_amount']); ?></td>
                <td><?php echo htmlspecialchars($row['order_status']); ?></td>
                <td><?php echo htmlspecialchars($row['order_date']); ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <script>
        function downloadPDF() {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();
            doc.text("Order Report", 10, 10);

            let table = document.getElementById("order-table");
            let rows = table.getElementsByTagName("tr");
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

            doc.save("Order_Report.pdf");
        }

        function downloadExcel() {
            let table = document.getElementById("order-table");
            let ws = XLSX.utils.table_to_sheet(table);
            let wb = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(wb, ws, "Orders");
            XLSX.writeFile(wb, "Order_Report.xlsx");
        }
    </script>

</body>
</html>
