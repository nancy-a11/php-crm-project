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

<h3 style="margin-bottom: 20px;"><i class="bi bi-person-plus-fill"></i> Add New Contact</h3>

<!-- ✅ AJAX-enabled form with Bootstrap -->
<form id="addContactForm" onsubmit="submitContact(event)" style="max-width: 600px;">
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
        <label class="form-label">Contact Name</label>
        <input name="contact_name" type="text" class="form-control" placeholder="Full Name" required style="border-radius: 8px;">
    </div>
    <div class="mb-3">
        <label class="form-label">Email</label>
        <input name="contact_email" type="email" class="form-control" placeholder="Email address" style="border-radius: 8px;">
    </div>
    <div class="mb-3">
        <label class="form-label">Phone</label>
        <input name="contact_phone" type="text" class="form-control" placeholder="Phone number" style="border-radius: 8px;">
    </div>
    <div class="mb-3">
        <label class="form-label">Position</label>
        <input name="position" type="text" class="form-control" placeholder="Position" style="border-radius: 8px;">
    </div>
    <button type="submit" class="btn btn-success"><i class="bi bi-person-check-fill"></i> Add Contact</button>
</form>

<!-- ✅ AJAX script -->
<script>
function submitContact(event) {
    event.preventDefault();
    const form = document.getElementById("addContactForm");
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



