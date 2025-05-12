<?php
include '../db.php';
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and get POST data
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $company = trim($_POST['company']);

    // Basic validation (optional)
    if (empty($name)) {
        echo "Name is required.";
        exit();
    }

    // Prepare and execute insert statement
    $stmt = $conn->prepare("INSERT INTO customers (name, email, phone, company) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $phone, $company);

    if ($stmt->execute()) {
        echo "Customer added successfully!";
    } else {
        echo "Error inserting customer: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>



