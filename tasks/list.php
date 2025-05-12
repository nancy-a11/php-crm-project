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
    <title>Tasks Management</title>
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
            color: #00A6FF;
            font-weight: bold;
            text-align: center;
        }

        .btn-add {
            display: block;
            width: 150px;
            margin: 15px auto;
            font-weight: bold;
        }

        table {
            width: 100%;
        }

        th {
            background:rgb(7, 45, 140);
            color: #ffffff;
            text-align: center;
        }

        td {
            text-align: center;
            color: #ffffff;
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
        <h2>Tasks Management 🎯</h2>
        <a href="add.php" class="btn btn-primary btn-add">+ Add Task</a>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Customer ID</th>
                    <th>Task Title</th>
                    <th>Task Description</th>
                    <th>Due Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $res = $conn->query("SELECT * FROM tasks");
                while ($row = $res->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['customer_id']}</td>
                        <td>{$row['task_title']}</td>
                        <td>{$row['task_description']}</td>
                        <td>{$row['due_date']}</td>
                        <td>{$row['status']}</td>
                        <td class='actions'>
                            <a href='edit.php?id={$row['id']}' class='btn btn-sm btn-warning'>Edit</a>
                            <a href='delete.php?id={$row['id']}' class='btn btn-sm btn-danger' onclick=\"return confirm('Are you sure you want to delete this task?')\">Delete</a>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>


