<?php
include '../db.php';
session_start();

if (!isset($_SESSION['user'])) {
    echo "Unauthorized access.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customer_id = $_POST['customer_id'];
    $contact_name = $_POST['contact_name'];
    $contact_email = $_POST['contact_email'];
    $contact_phone = $_POST['contact_phone'];
    $position = $_POST['position'];

    // Basic validation (optional)
    if (empty($customer_id) || empty($contact_name)) {
        echo "Customer and Contact Name are required.";
        exit();
    }

    $stmt = $conn->prepare("INSERT INTO contacts (customer_id, contact_name, contact_email, contact_phone, position) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $customer_id, $contact_name, $contact_email, $contact_phone, $position);

    if ($stmt->execute()) {
        echo "Contact added successfully!";
    } else {
        echo "Error inserting contact: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

