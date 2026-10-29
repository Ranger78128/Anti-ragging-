<?php

require_once "../includes/student_auth.php";
require_once "../includes/db.php";

$id =
    intval($_GET["id"] ?? 0);

$stmt = $conn->prepare(
    "SELECT *
     FROM complaints
     WHERE id=?
     AND student_id=?
     LIMIT 1"
);

$stmt->bind_param(
    "ii",
    $id,
    $_SESSION["student_id"]
);

$stmt->execute();

$complaint =
    $stmt->get_result()
    ->fetch_assoc();

if (!$complaint) {

    die("Complaint not found.");

}

?>

<!DOCTYPE html>

<html>

<head>

<title>
Complaint #<?= $id ?>
</title>

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

<a href="my_complaints.php">
My Complaints
</a>

<a href="../logout.php">
Logout
</a>

</div>

</nav>

<div class="container narrow">

<div class="panel">

<div class="page-header">

<div>

<h1>

Complaint #<?= $id ?>

</h1>

<p>

<?= htmlspecialchars(
$complaint["title"]
) ?>

</p>

</div>

<span class="status">

<?= htmlspecialchars(
$complaint["status"]
) ?>

</span>

</div>

<hr>

<h3>
Incident Date
</h3>

<p>
<?= htmlspecialchars(
$complaint["incident_date"]
) ?>
</p>

<h3>
Location
</h3>

<p>
<?= htmlspecialchars(
$complaint["location"]
) ?>
</p>

<h3>
Person Involved
</h3>

<p>

<?= htmlspecialchars(
$complaint["accused_name"]
?: "Not provided"
) ?>

</p>

<h3>
Description
</h3>

<p class="description">

<?= nl2br(
htmlspecialchars(
$complaint["description"]
)
) ?>

</p>

<h3>
Admin Remarks
</h3>

<p class="description">

<?= nl2br(
htmlspecialchars(
$complaint["admin_remarks"]
?: "No remarks yet."
)
) ?>

</p>

<a
href="my_complaints.php"
class="btn secondary">

← Back

</a>

</div>

</div>

</body>

</html>