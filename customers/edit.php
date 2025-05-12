<?php
include '../db.php';
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit();
}

$id = $_GET['id'] ?? null;
if (!$id) {
    echo "Invalid customer ID.";
    exit();
}

// Fetch existing data
$result = $conn->query("SELECT * FROM customers WHERE id = $id");
$customer = $result->fetch_assoc();

include('../includes/header.php');
?>

<div class="container mt-4">
    <h3 class="mb-4"><i class="bi bi-pencil-square"></i> Edit Customer</h3>

    <form method="post" style="max-width: 600px;">
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input name="name" class="form-control" value="<?= htmlspecialchars($customer['name'] ?? '') ?>" required style="border-radius: 8px;">
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input name="email" class="form-control" value="<?= htmlspecialchars($customer['email'] ?? '') ?>" style="border-radius: 8px;">
        </div>
        <div class="mb-3">
            <label class="form-label">Phone</label>
            <input name="phone" class="form-control" value="<?= htmlspecialchars($customer['phone'] ?? '') ?>" style="border-radius: 8px;">
        </div>
        <div class="mb-3">
            <label class="form-label">Company</label>
            <input name="company" class="form-control" value="<?= htmlspecialchars($customer['company'] ?? '') ?>" style="border-radius: 8px;">
        </div>
        <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Update Customer</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $phone = $_POST['phone'] ?? '';
        $company = $_POST['company'] ?? '';

        $stmt = $conn->prepare("UPDATE customers SET name = ?, email = ?, phone = ?, company = ? WHERE id = ?");
        if ($stmt) {
            $stmt->bind_param("ssssi", $name, $email, $phone, $company, $id);
            if ($stmt->execute()) {
                echo "<script>alert('Customer updated successfully'); window.location.href='list.php';</script>";
            } else {
                echo "<div class='alert alert-danger mt-3'>Update failed: " . $stmt->error . "</div>";
            }
        } else {
            echo "<div class='alert alert-danger mt-3'>Query error: " . $conn->error . "</div>";
        }
    }
    ?>
</div>

<?php include('../includes/footer.php'); ?>





