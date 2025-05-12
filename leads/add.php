<?php include '../db.php'; ?>
<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit();
}
include('../includes/header.php');

$result = $conn->query("SELECT id, name FROM customers");
?>

<h3 style="margin-bottom: 20px;"><i class="bi bi-lightbulb-fill"></i> Add New Lead</h3>

<!-- ✅ AJAX-enabled form with Bootstrap -->
<form id="addLeadForm" onsubmit="submitLead(event)" style="max-width: 600px;">
    <div class="mb-3">
        <label class="form-label">Customer</label>
        <select name="customer_id" class="form-control" required>
            <option value="">Select Customer</option>
            <?php while ($row = $result->fetch_assoc()): ?>
                <option value="<?= $row['id'] ?>"><?= htmlspecialchars($row['name']) ?></option>
            <?php endwhile; ?>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Lead Title</label>
        <input name="lead_title" type="text" class="form-control" placeholder="Enter lead title" required style="border-radius: 8px;">
    </div>
    <div class="mb-3">
        <label class="form-label">Lead Description</label>
        <textarea name="lead_description" class="form-control" placeholder="Describe the lead" style="border-radius: 8px;"></textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Status</label>
        <select name="status" class="form-control" required>
            <option>New</option>
            <option>Contacted</option>
            <option>Qualified</option>
            <option>Lost</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Add Lead</button>
</form>

<!-- ✅ AJAX script -->
<script>
function submitLead(event) {
    event.preventDefault();
    const form = document.getElementById("addLeadForm");
    const formData = new FormData(form);

    fetch("add_action.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.text())
    .then(data => {
        alert(data);      // Show result
        form.reset();     // Clear form
    })
    .catch(error => alert("Error: " + error));
}
</script>

<?php include('../includes/footer.php'); ?>



