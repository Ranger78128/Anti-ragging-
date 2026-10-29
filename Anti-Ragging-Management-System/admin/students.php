<?php

require_once "../includes/admin_auth.php";
require_once "../includes/db.php";

$result =
    $conn->query(
        "SELECT
            id,
            name,
            email,
            phone,
            course,
            roll_no,
            created_at
         FROM students
         ORDER BY created_at DESC"
    );

?>

<!DOCTYPE html>

<html>

<head>

<title>
Students
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
Registered Students
</h1>

<div class="panel table-container">

<table>

<tr>

<th>ID</th>

<th>Name</th>

<th>Email</th>

<th>Roll No</th>

<th>Course</th>

<th>Phone</th>

<th>Registered</th>

</tr>

<?php while (
$row =
$result->fetch_assoc()
): ?>

<tr>

<td>
<?= $row["id"] ?>
</td>

<td>
<?= htmlspecialchars(
$row["name"]
) ?>
</td>

<td>
<?= htmlspecialchars(
$row["email"]
) ?>
</td>

<td>
<?= htmlspecialchars(
$row["roll_no"]
) ?>
</td>

<td>
<?= htmlspecialchars(
$row["course"]
) ?>
</td>

<td>
<?= htmlspecialchars(
$row["phone"]
) ?>
</td>

<td>

<?= date(
"d M Y",
strtotime(
$row["created_at"]
)
) ?>

</td>

</tr>

<?php endwhile; ?>

</table>

</div>

</div>

</body>

</html>