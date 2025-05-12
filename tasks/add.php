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

<h3 style="margin-bottom: 20px;"><i class="bi bi-clipboard-plus"></i> Add New Task</h3>

<!-- ✅ AJAX-enabled form with Bootstrap -->
<form id="addTaskForm" onsubmit="submitTask(event)" style="max-width: 600px;">
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
        <label class="form-label">Task Title</label>
        <input name="task_title" type="text" class="form-control" placeholder="Enter task title" required style="border-radius: 8px;">
    </div>
    <div class="mb-3">
        <label class="form-label">Task Description</label>
        <textarea name="task_description" class="form-control" placeholder="Describe the task" style="border-radius: 8px;"></textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Due Date</label>
        <input name="due_date" type="date" class="form-control" style="border-radius: 8px;">
    </div>
    <div class="mb-3">
        <label class="form-label">Status</label>
        <select name="status" class="form-control" required>
            <option>Pending</option>
            <option>In Progress</option>
            <option>Completed</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Add Task</button>
</form>

<!-- ✅ AJAX script -->
<script>
function submitTask(event) {
    event.preventDefault();
    const form = document.getElementById("addTaskForm");
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


