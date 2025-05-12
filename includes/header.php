
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CRM Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f5f7fa;
            display: flex;
        }
        .sidebar {
            min-width: 220px;
            max-width: 220px;
            background-color:rgb(6, 57, 134);
            color: white;
            height: 100vh;
            position: fixed;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 15px 20px;
        }
        .sidebar a:hover {
            background-color: #0b5ed7;
        }
        .main-content {
            margin-left: 220px;
            padding: 30px;
            width: 100%;
        }
        .sidebar h4 {
            padding: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h4><i class="bi bi-speedometer2"></i> CRM</h4>
    <a href="/crm_project/dashboard.php"><i class="bi bi-house-door-fill"></i> Dashboard</a>
    <a href="/crm_project/customers/list.php"><i class="bi bi-people-fill"></i> Customers</a>
    <a href="/crm_project/contacts/list.php"><i class="bi bi-telephone-fill"></i> Contacts</a>
    <a href="/crm_project/leads/list.php"><i class="bi bi-person-lines-fill"></i> Leads</a>
    <a href="/crm_project/tasks/list.php"><i class="bi bi-list-check"></i> Tasks</a>
    <a href="/crm_project/logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
</div>

<div class="main-content">
