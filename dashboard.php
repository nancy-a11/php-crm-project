<?php
include 'db.php';
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
include 'includes/header.php';


// Fetch counts
$cust = $conn->query("SELECT COUNT(*) AS total FROM customers")->fetch_assoc()['total'];
$leads = $conn->query("SELECT COUNT(*) AS total FROM leads")->fetch_assoc()['total'];
$tasks = $conn->query("SELECT COUNT(*) AS total FROM tasks")->fetch_assoc()['total'];
?>

<style>
        body {
            background:#f8f9fa;
         
            padding: 20px;
        }
        </style>

<h2>Welcome to CRM Dashboard</h2>
<div class="row text-center">
    <div class="col-md-4">
        <div class="card text-white bg-primary mb-3">
            <div class="card-body">
                <h4 class="card-title"><?= $cust ?> Customers</h4>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-success mb-3">
            <div class="card-body">
                <h4 class="card-title"><?= $leads ?> Leads</h4>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-warning mb-3">
            <div class="card-body">
                <h4 class="card-title"><?= $tasks ?> Tasks</h4>
            </div>
        </div>
    </div>
</div>

<canvas id="chart" width="400" height="150"></canvas>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('chart').getContext('2d');
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Customers', 'Leads', 'Tasks'],
        datasets: [{
            label: 'Total',
            data: [<?= $cust ?>, <?= $leads ?>, <?= $tasks ?>],
            backgroundColor: ['blue', 'green', 'orange']
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: false } }
    }
});
</script>

<?php include 'includes/footer.php'; ?>
