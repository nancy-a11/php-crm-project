<?php
include '../db.php';
session_start();

if (!isset($_SESSION['user'])) {
    echo "Unauthorized access.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customer_id = $_POST['customer_id'];
    $lead_title = $_POST['lead_title'];
    $lead_description = $_POST['lead_description'];
    $status = $_POST['status'];

    // Basic validation
    if (empty($customer_id) || empty($lead_title) || empty($status)) {
        echo "Customer, title, and status are required.";
        exit();
    }

    $stmt = $conn->prepare("INSERT INTO leads (customer_id, lead_title, lead_description, status) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $customer_id, $lead_title, $lead_description, $status);

    if ($stmt->execute()) {
        echo "Lead added successfully!";
    } else {
        echo "Error inserting lead: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

