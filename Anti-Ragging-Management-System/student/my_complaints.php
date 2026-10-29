<?php

require_once "../includes/student_auth.php";
require_once "../includes/db.php";

$stmt = $conn->prepare(
    "SELECT
        id,
        title,
        location,
        status,
        created_at
     FROM complaints
     WHERE student_id=?
     ORDER BY created_at DESC"
);

$stmt->bind_param(
    "i",
    $_SESSION["student_id"]
);

$stmt->execute();

$result =
    $stmt->get_result();

?>

<!DOCTYPE html>

<html>

<head>

<title>My Complaints</title>

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

<a href="../logout.php">
Logout
</a>

</div>

</nav>

<div class="container">

<div class="page-header">

<h1>
My Complaints
</h1>

<a
href="submit_complaint.php"
class="btn primary">

+ New Complaint

</a>

</div>

<div class="panel table-container">

<table>

<tr>

<th>ID</th>

<th>Title</th>

<th>Location</th>

<th>Status</th>

<th>Date</th>

<th>Action</th>

</tr>

<?php while (
$row = $result->fetch_assoc()
): ?>

<tr>

<td>
#<?= $row["id"] ?>
</td>

<td>
<?= htmlspecialchars($row["title"]) ?>
</td>

<td>
<?= htmlspecialchars($row["location"]) ?>
</td>

<td>

<span class="status">

<?= htmlspecialchars($row["status"]) ?>

</span>

</td>

<td>

<?= date(
"d M Y",
strtotime($row["created_at"])
) ?>

</td>

<td>

<a
href="complaint_details.php?id=<?= $row["id"] ?>">

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