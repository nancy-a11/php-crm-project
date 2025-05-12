<?php
include '../db.php';
session_start();

if (!isset($_SESSION['user'])) {
    echo "Unauthorized access.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customer_id = $_POST['customer_id'];
    $task_title = $_POST['task_title'];
    $task_description = $_POST['task_description'];
    $due_date = $_POST['due_date'];
    $status = $_POST['status'];

    // Basic validation
    if (empty($customer_id) || empty($task_title) || empty($due_date) || empty($status)) {
        echo "Customer, title, due date, and status are required.";
        exit();
    }

    $stmt = $conn->prepare("INSERT INTO tasks (customer_id, task_title, task_description, due_date, status) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $customer_id, $task_title, $task_description, $due_date, $status);

    if ($stmt->execute()) {
        echo "Task added successfully!";
    } else {
        echo "Error inserting task: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

