<?php
include '../db.php';
header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename=customers.csv');

$output = fopen("php://output", "w");
fputcsv($output, ['ID', 'Name', 'Email', 'Phone', 'Company']);

$res = $conn->query("SELECT * FROM customers");
while ($row = $res->fetch_assoc()) {
    fputcsv($output, $row);
}
fclose($output);
?>
