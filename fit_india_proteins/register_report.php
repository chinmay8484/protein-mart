<?php
include "db_connect.php";

if (isset($_GET['action'])) {
    if ($_GET['action'] == 'csv') {
        // CSV Download
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=user_report.csv');

        $output = fopen('php://output', 'w');
        fputcsv($output, array('ID', 'Name', 'Email'));

        $query = "SELECT id, name, email FROM users";
        $result = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            fputcsv($output, $row);
        }

        fclose($output);
        exit();
    } elseif ($_GET['action'] == 'pdf') {
        // PDF Download
        require('fpdf/fpdf.php');

        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(190, 10, 'User Report', 1, 1, 'C');

        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(30, 10, 'ID', 1);
        $pdf->Cell(80, 10, 'Name', 1);
        $pdf->Cell(80, 10, 'Email', 1);
        $pdf->Ln();

        $pdf->SetFont('Arial', '', 12);
        $query = "SELECT id, name, email FROM users";
        $result = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            $pdf->Cell(30, 10, $row['id'], 1);
            $pdf->Cell(80, 10, $row['name'], 1);
            $pdf->Cell(80, 10, $row['email'], 1);
            $pdf->Ln();
        }

        $pdf->Output();
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>User Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
        }

        .container {
            width: 80%;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h2 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: #8B4513; /* Brown */
            color: white;
        }

        tr:nth-child(even) {
            background: #f9f9f9;
        }

        .btn-container {
            margin-bottom: 20px;
        }

        .btn {
            display: inline-block;
            padding: 10px 15px;
            margin: 5px;
            background: #654321;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }

        .btn:hover {
            background: #543210;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Registered Users Report</h2>
    
    <div class="btn-container">
        <a href="?action=csv" class="btn">Download CSV</a>
        <a href="?action=pdf" class="btn">Download PDF</a>
        <button onclick="printReport()" class="btn">Print Report</button>
    </div>

    <table id="userTable">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
        </tr>

        <?php
        $query = "SELECT id, name, email FROM users";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['email']}</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No users found</td></tr>";
        }

        mysqli_close($conn);
        ?>
    </table>
</div>

<script>
    function printReport() {
        var printContent = document.querySelector('.container').innerHTML;
        var originalContent = document.body.innerHTML;
        
        document.body.innerHTML = printContent;
        window.print();
        document.body.innerHTML = originalContent;
    }
</script>

</body>
</html>
