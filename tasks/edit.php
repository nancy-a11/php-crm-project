<?php
include '../db.php';
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit();
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$task = [
    'task_title' => '',
    'task_description' => '',
    'due_date' => '',
    'status' => '',
    'customer_id' => ''
];

if ($id > 0) {
    $result = $conn->query("SELECT * FROM tasks WHERE id=$id");
    if ($result && $result->num_rows > 0) {
        $task = $result->fetch_assoc();
    } else {
        die("<div class='alert alert-danger'>Task not found.</div>");
    }
}

include('../includes/header.php');
?>

<h3 style="margin-bottom: 20px;"><i class="bi bi-pencil-square"></i> Edit Task</h3>

<form method="post" style="max-width: 600px;">
    <div class="mb-3">
        <label class="form-label">Customer ID</label>
        <input name="customer_id" type="number" class="form-control" value="<?= htmlspecialchars($task['customer_id']) ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Task Title</label>
        <input name="task_title" type="text" class="form-control" value="<?= htmlspecialchars($task['task_title']) ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Task Description</label>
        <textarea name="task_description" class="form-control"><?= htmlspecialchars($task['task_description']) ?></textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Due Date</label>
        <input name="due_date" type="date" class="form-control" value="<?= htmlspecialchars($task['due_date']) ?>">
    </div>
    <div class="mb-3">
        <label class="form-label">Status</label>
        <select name="status" class="form-control" required>
            <option <?= $task['status'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
            <option <?= $task['status'] == 'In Progress' ? 'selected' : '' ?>>In Progress</option>
            <option <?= $task['status'] == 'Completed' ? 'selected' : '' ?>>Completed</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Update Task</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize inputs
    $customer_id = (int)$_POST['customer_id'];
    $task_title = $_POST['task_title'] ?? '';
    $task_description = $_POST['task_description'] ?? '';
    $due_date = $_POST['due_date'] ?? null;
    $status = $_POST['status'] ?? 'Pending';

    // Prepare and bind
    $stmt = $conn->prepare("UPDATE tasks SET customer_id=?, task_title=?, task_description=?, due_date=?, status=? WHERE id=?");
    $stmt->bind_param("issssi", $customer_id, $task_title, $task_description, $due_date, $status, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Task updated successfully'); window.location.href='list.php';</script>";
    } else {
        echo "<div class='alert alert-danger mt-3'>Update failed! (" . $stmt->error . ")</div>";
    }
}
include('../includes/footer.php');
?>




