<?php

require_once "../includes/admin_auth.php";
require_once "../includes/db.php";

$total =
    $conn->query(
        "SELECT COUNT(*) total
         FROM complaints"
    )->fetch_assoc()["total"];

$pending =
    $conn->query(
        "SELECT COUNT(*) total
         FROM complaints
         WHERE status='Pending'"
    )->fetch_assoc()["total"];

$investigation =
    $conn->query(
        "SELECT COUNT(*) total
         FROM complaints
         WHERE status='Under Investigation'"
    )->fetch_assoc()["total"];

$resolved =
    $conn->query(
        "SELECT COUNT(*) total
         FROM complaints
         WHERE status='Resolved'"
    )->fetch_assoc()["total"];

$students =
    $conn->query(
        "SELECT COUNT(*) total
         FROM students"
    )->fetch_assoc()["total"];

?>

<!DOCTYPE html>

<html>

<head>

<title>Admin Dashboard</title>

<link rel="stylesheet"
href="../assets/css/style.css">

</head>

<body>

<nav class="navbar admin">

<div>
Anti-Ragging Admin
</div>

<div>

<a href="dashboard.php">
Dashboard
</a>

<a href="complaints.php">
Complaints
</a>

<a href="students.php">
Students
</a>

<a href="reports.php">
Reports
</a>

<a href="logout.php">
Logout
</a>

</div>

</nav>

<div class="container">

<h1>
Admin Dashboard
</h1>

<p class="muted">

Welcome,
<?= htmlspecialchars(
$_SESSION["admin_name"]
) ?>

</p>

<div class="stats">

<div class="stat-card">

<span>Total Complaints</span>

<strong>
<?= $total ?>
</strong>

</div>

<div class="stat-card">

<span>Pending</span>

<strong>
<?= $pending ?>
</strong>

</div>

<div class="stat-card">

<span>Investigation</span>

<strong>
<?= $investigation ?>
</strong>

</div>

<div class="stat-card">

<span>Resolved</span>

<strong>
<?= $resolved ?>
</strong>

</div>

<div class="stat-card">

<span>Registered Students</span>

<strong>
<?= $students ?>
</strong>

</div>

</div>

<div class="panel">

<h2>
Quick Actions
</h2>

<a
href="complaints.php"
class="btn primary">

Manage Complaints

</a>

<a
href="students.php"
class="btn secondary">

View Students

</a>

<a
href="reports.php"
class="btn dark">

View Reports

</a>

</div>

</div>

</body>

</html>