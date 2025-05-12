
<?php include '../db.php'; ?>
<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit();
}
include('../includes/header.php');
?>

<h3 style="margin-bottom: 20px;"><i class="bi bi-person-plus-fill"></i> Add New Customer</h3>

<!-- ✅ AJAX-enabled form with Bootstrap -->
<form id="addForm" onsubmit="submitForm(event)" style="max-width: 600px;">
    <div class="mb-3">
        <label class="form-label">Name</label>
        <input name="name" type="text" class="form-control" placeholder="Full Name" required style="border-radius: 8px;">
    </div>
    <div class="mb-3">
        <label class="form-label">Email</label>
        <input name="email" type="email" class="form-control" placeholder="Email address" style="border-radius: 8px;">
    </div>
    <div class="mb-3">
        <label class="form-label">Phone</label>
        <input name="phone" type="text" class="form-control" placeholder="Phone number" style="border-radius: 8px;">
    </div>
    <div class="mb-3">
        <label class="form-label">Company</label>
        <input name="company" type="text" class="form-control" placeholder="Company name" style="border-radius: 8px;">
    </div>
    <button type="submit" class="btn btn-success"><i class="bi bi-plus-circle"></i> Add Customer</button>
</form>

<!-- ✅ AJAX script -->
<script>
function submitForm(event) {
    event.preventDefault();
    const form = document.getElementById("addForm");
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
