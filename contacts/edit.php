<?php
include '../db.php';
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit();
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$res = $conn->query("SELECT * FROM contacts WHERE id=$id");
if (!$res || $res->num_rows === 0) {
    die("<div class='alert alert-danger'>Contact not found.</div>");
}
$row = $res->fetch_assoc();

include('../includes/header.php');
?>

<h3 style="margin-bottom: 20px;"><i class="bi bi-person-lines-fill"></i> Edit Contact</h3>

<form method="post" style="max-width: 600px;">
    <div class="mb-3">
        <label class="form-label">Customer ID</label>
        <input name="customer_id" type="number" class="form-control" value="<?= htmlspecialchars($row['customer_id']) ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Contact Name</label>
        <input name="contact_name" type="text" class="form-control" value="<?= htmlspecialchars($row['contact_name']) ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Contact Email</label>
        <input name="contact_email" type="email" class="form-control" value="<?= htmlspecialchars($row['contact_email']) ?>">
    </div>
    <div class="mb-3">
        <label class="form-label">Contact Phone</label>
        <input name="contact_phone" type="text" class="form-control" value="<?= htmlspecialchars($row['contact_phone']) ?>">
    </div>
    <div class="mb-3">
        <label class="form-label">Position</label>
        <input name="position" type="text" class="form-control" value="<?= htmlspecialchars($row['position']) ?>">
    </div>

    <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Update Contact</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize input
    $customer_id = (int)$_POST['customer_id'];
    $contact_name = $_POST['contact_name'] ?? '';
    $contact_email = $_POST['contact_email'] ?? '';
    $contact_phone = $_POST['contact_phone'] ?? '';
    $position = $_POST['position'] ?? '';

    // Update query
    $stmt = $conn->prepare("UPDATE contacts SET customer_id=?, contact_name=?, contact_email=?, contact_phone=?, position=? WHERE id=?");
    $stmt->bind_param("issssi", $customer_id, $contact_name, $contact_email, $contact_phone, $position, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Contact updated successfully'); window.location.href='list.php';</script>";
    } else {
        echo "<div class='alert alert-danger mt-3'>Update failed! (" . $stmt->error . ")</div>";
    }
}

include('../includes/footer.php');
?>
