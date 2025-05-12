<?php
include '../db.php';
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit();
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$res = $conn->query("SELECT * FROM leads WHERE id=$id");
if (!$res || $res->num_rows === 0) {
    die("<div class='alert alert-danger'>Lead not found.</div>");
}
$lead = $res->fetch_assoc();

include('../includes/header.php');
?>

<div class="container mt-4">
    <h3 class="mb-4"><i class="bi bi-pencil-square"></i> Edit Lead</h3>

    <form method="post" class="card p-4 shadow-sm" style="max-width: 650px;">
        <div class="mb-3">
            <label class="form-label">Customer ID</label>
            <input type="number" name="customer_id" class="form-control" value="<?= htmlspecialchars($lead['customer_id']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Lead Title</label>
            <input type="text" name="lead_title" class="form-control" value="<?= htmlspecialchars($lead['lead_title']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Lead Description</label>
            <textarea name="lead_description" class="form-control" rows="3"><?= htmlspecialchars($lead['lead_description']) ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-select" required>
                <option value="New" <?= $lead['status'] == 'New' ? 'selected' : '' ?>>New</option>
                <option value="Contacted" <?= $lead['status'] == 'Contacted' ? 'selected' : '' ?>>Contacted</option>
                <option value="Qualified" <?= $lead['status'] == 'Qualified' ? 'selected' : '' ?>>Qualified</option>
                <option value="Lost" <?= $lead['status'] == 'Lost' ? 'selected' : '' ?>>Lost</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">
            <i class="bi bi-save"></i> Update Lead
        </button>
    </form>
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customer_id = (int)$_POST['customer_id'];
    $lead_title = $_POST['lead_title'] ?? '';
    $lead_description = $_POST['lead_description'] ?? '';
    $status = $_POST['status'] ?? 'New';

    $stmt = $conn->prepare("UPDATE leads SET customer_id=?, lead_title=?, lead_description=?, status=? WHERE id=?");
    $stmt->bind_param("isssi", $customer_id, $lead_title, $lead_description, $status, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Lead updated successfully'); window.location.href='list.php';</script>";
    } else {
        echo "<div class='alert alert-danger mt-3'>Update failed! (" . $stmt->error . ")</div>";
    }
}

include('../includes/footer.php');
?>
