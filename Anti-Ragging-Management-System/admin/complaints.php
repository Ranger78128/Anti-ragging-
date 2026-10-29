<?php

require_once "../includes/admin_auth.php";
require_once "../includes/db.php";

$result =
    $conn->query(
        "SELECT
            c.id,
            c.title,
            c.location,
            c.status,
            c.created_at,
            s.name AS student_name,
            s.email AS student_email
         FROM complaints c
         INNER JOIN students s
         ON c.student_id=s.id
         ORDER BY c.created_at DESC"
    );

?>

<!DOCTYPE html>

<html>

<head>

<title>Manage Complaints</title>

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
Complaint Management
</h1>

<div class="panel table-container">

<table>

<tr>

<th>ID</th>

<th>Student</th>

<th>Title</th>

<th>Location</th>

<th>Status</th>

<th>Date</th>

<th>Action</th>

</tr>

<?php while (
$row =
$result->fetch_assoc()
): ?>

<tr>

<td>
#<?= $row["id"] ?>
</td>

<td>

<?= htmlspecialchars(
$row["student_name"]
) ?>

<br>

<small>
<?= htmlspecialchars(
$row["student_email"]
) ?>
</small>

</td>

<td>

<?= htmlspecialchars(
$row["title"]
) ?>

</td>

<td>

<?= htmlspecialchars(
$row["location"]
) ?>

</td>

<td>

<span class="status">

<?= htmlspecialchars(
$row["status"]
) ?>

</span>

</td>

<td>

<?= date(
"d M Y",
strtotime(
$row["created_at"]
)
) ?>

</td>

<td>

<a href="complaint_details.php?id=<?= $row["id"] ?>">

View

</a>

</td>

</tr>

<?php endwhile; ?>

</table>

</div>

</div>

</body>

</html>