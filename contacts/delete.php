<?php
include '../db.php';
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit();
}
$id = $_GET['id'];
$conn->query("DELETE FROM contacts WHERE id=$id");
header("Location: list.php");
