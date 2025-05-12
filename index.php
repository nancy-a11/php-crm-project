<?php
include 'db.php';
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
$greetings = [
  "Hope you're crushing your goals today,",
  "Great to see you back,",
  "Ready to manage some customers,",
  "The CRM's all yours,",
  "Welcome to mission control,"
];
$greeting = $greetings[array_rand($greetings)];

$customerCount = $conn->query("SELECT COUNT(*) FROM customers")->fetch_row()[0];
$contactsCount = $conn->query("SELECT COUNT(*) FROM contacts")->fetch_row()[0];
$tasksCount = $conn->query("SELECT COUNT(*) FROM tasks")->fetch_row()[0];
$leadsCount = $conn->query("SELECT COUNT(*) FROM leads")->fetch_row()[0];

include('includes/header.php'); // loads sidebar and bootstrap
?>

<div class="container-fluid px-4">
    <h2 class="mt-4">👋 Welcome back,<?=$greeting ?> <?= htmlspecialchars($_SESSION['user']) ?>!</h2>
    <p class="text-muted">Here’s what’s happening today in your CRM dashboard.</p>

    <div class="row mt-4">
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card text-white bg-primary shadow" style="border-radius: 12px;">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-people-fill"></i> Customers</h5>
                    <h3><?= $customerCount ?></h3>
                </div>
            </div>
        </div>
        <div class="row mt-4">
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card text-white bg-primary shadow" style="border-radius: 12px;">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-people-fill"></i> Contacts</h5>
                    <h3><?= $contactsCount ?></h3>
                </div>
            </div>
        </div>
       
    <h4 class="mt-5">Quick Links</h4>
    <ul class="list-group" style="max-width: 400px;">
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <a href="customers/list.php" class="text-decoration-none"><i class="bi bi-list-check"></i> View Customers👥 </a>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <a href="leads/list.php" class="text-decoration-none"><i class="bi bi-list-check"></i> View Leads 🌟 </a>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <a href="tasks/list.php" class="text-decoration-none"><i class="bi bi-list-check"></i> View Tasks 🎯</a>
        </li>
       
        <li class="list-group-item">
            <a href="logout.php" class="btn btn-outline-danger w-100"><i class="bi bi-box-arrow-right"></i> Logout</a>
        </li>
    </ul>
</div>

<?php include('includes/footer.php'); ?>


