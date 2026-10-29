<?php

require_once "../includes/admin_auth.php";
require_once "../includes/db.php";

$id =
    intval($_GET["id"] ?? 0);

$stmt = $conn->prepare(
    "SELECT
        c.*,
        s.name AS student_name,
        s.email AS student_email,
        s.roll_no
     FROM complaints c
     INNER JOIN students s
     ON c.student_id=s.id
     WHERE c.id=?
     LIMIT 1"
);

$stmt->bind_param(
    "i",
    $id
);

$stmt->execute();

$complaint =
    $stmt->get_result()
    ->fetch_assoc();

if (!$complaint) {

    die(
        "Complaint not found."
    );

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

<a href="logout.php">
Logout
</a>

</div>

</nav>

<div class="container narrow">

<div class="panel">

<h1>
Complaint #<?= $id ?>
</h1>

<p>

<b>
Student:
</b>

<?= htmlspecialchars(
$complaint["student_name"]
) ?>

</p>

<p>

<b>
Email:
</b>

<?= htmlspecialchars(
$complaint["student_email"]
) ?>

</p>

<p>

<b>
Roll No:
</b>

<?= htmlspecialchars(
$complaint["roll_no"]
) ?>

</p>

<hr>

<h3>
Title
</h3>

<p>
<?= htmlspecialchars(
$complaint["title"]
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

<a
class="btn primary"
href="update_complaint.php?id=<?= $id ?>">

Update Complaint

</a>

<a
class="btn secondary"
href="complaints.php">

Back

</a>

</div>

</div>

</body>

</html>