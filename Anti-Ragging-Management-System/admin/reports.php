<?php

require_once "../includes/admin_auth.php";
require_once "../includes/db.php";

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

$rejected =
    $conn->query(
        "SELECT COUNT(*) total
         FROM complaints
         WHERE status='Rejected'"
    )->fetch_assoc()["total"];

?>

<!DOCTYPE html>

<html>

<head>

<title>
Reports
</title>

<link rel="stylesheet"
href="../assets/css/style.css">

</head>

<body>

<nav class="navbar admin">

<div>
Admin Panel
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
Complaint Reports
</h1>

<div class="stats">

<div class="stat-card">
<span>Pending</span>
<strong><?= $pending ?></strong>
</div>

<div class="stat-card">
<span>Investigation</span>
<strong><?= $investigation ?></strong>
</div>

<div class="stat-card">
<span>Resolved</span>
<strong><?= $resolved ?></strong>
</div>

<div class="stat-card">
<span>Rejected</span>
<strong><?= $rejected ?></strong>
</div>

</div>

<div class="panel">

<h2>
Summary
</h2>

<p>
Pending complaints:
<b><?= $pending ?></b>
</p>

<p>
Under investigation:
<b><?= $investigation ?></b>
</p>

<p>
Resolved complaints:
<b><?= $resolved ?></b>
</p>

<p>
Rejected complaints:
<b><?= $rejected ?></b>
</p>

</div>

</div>

</body>

</html>