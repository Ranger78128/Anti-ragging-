<?php

require_once "../includes/student_auth.php";
require_once "../includes/db.php";

$student_id =
    $_SESSION["student_id"];

$stmt = $conn->prepare(
    "SELECT
        COUNT(*) AS total,
        SUM(status='Pending') AS pending,
        SUM(status='Under Investigation') AS investigation,
        SUM(status='Resolved') AS resolved
     FROM complaints
     WHERE student_id=?"
);

$stmt->bind_param(
    "i",
    $student_id
);

$stmt->execute();

$stats =
    $stmt->get_result()->fetch_assoc();

?>

<!DOCTYPE html>

<html>

<head>

<title>Student Dashboard</title>

<link rel="stylesheet"
href="../assets/css/style.css">

</head>

<body>

<nav class="navbar">

<div>
Anti-Ragging System
</div>

<div>

<a href="dashboard.php">
Dashboard
</a>

<a href="submit_complaint.php">
Report
</a>

<a href="my_complaints.php">
My Complaints
</a>

<a href="profile.php">
Profile
</a>

<a href="../logout.php">
Logout
</a>

</div>

</nav>

<div class="container">

<div class="page-header">

<div>

<h1>
Welcome,
<?= htmlspecialchars($_SESSION["student_name"]) ?>
</h1>

<p class="muted">
Manage your complaints securely.
</p>

</div>

<a href="submit_complaint.php"
class="btn primary">

+ Report Incident

</a>

</div>

<div class="stats">

<div class="stat-card">

<span>Total Complaints</span>

<strong>
<?= $stats["total"] ?? 0 ?>
</strong>

</div>

<div class="stat-card">

<span>Pending</span>

<strong>
<?= $stats["pending"] ?? 0 ?>
</strong>

</div>

<div class="stat-card">

<span>Investigation</span>

<strong>
<?= $stats["investigation"] ?? 0 ?>
</strong>

</div>

<div class="stat-card">

<span>Resolved</span>

<strong>
<?= $stats["resolved"] ?? 0 ?>
</strong>

</div>

</div>

<div class="panel">

<h2>
Your Rights
</h2>

<p>
You can report ragging incidents confidentially.
Your complaint can be tracked using your student account.
</p>

<a href="submit_complaint.php"
class="btn primary">

Report a Complaint

</a>

</div>

</div>

</body>

</html>