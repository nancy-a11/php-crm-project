<?php
include '../db.php';
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit();
}
include '../includes/header.php';


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Customers Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background: #f8f9fa;
            padding: 20px;
        }

        .container {
            max-width: 900px;
            margin: auto;
            background:rgb(6, 57, 134);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #007BFF;
            font-weight: bold;
            text-align: center;
        }

        .btn-add {
            display: block;
            width: 200px;
            margin: 15px auto;
            font-weight: bold;
        }

        table {
            width: 100%;
        }

        th {
            background: #007BFF;
            color: white;
            text-align: center;
        }

        td {
            text-align: center;
        }

        .actions a {
            margin: 3px;
        }

        .actions a:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Customers Management 🏢</h2>
        <a href="add.php" class="btn btn-primary btn-add">+ Add Customer</a>
        <a href="export.php" class="btn btn-success btn-add">Export as CSV</a>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Customer Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Company</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $res = $conn->query("SELECT * FROM customers");
                while ($row = $res->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['name']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['phone']}</td>
                        <td>{$row['company']}</td>
                        <td class='actions'>
                            <a href='edit.php?id={$row['id']}' class='btn btn-sm btn-warning'>Edit</a>
                            <a href='delete.php?id={$row['id']}' class='btn btn-sm btn-danger' onclick=\"return confirm('Are you sure you want to delete this customer?')\">Delete</a>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
<?php include '../includes/footer.php';

