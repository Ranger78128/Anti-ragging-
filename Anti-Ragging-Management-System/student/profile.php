<?php

require_once "../includes/student_auth.php";
require_once "../includes/db.php";

$id =
    $_SESSION["student_id"];

$message = "";

$stmt = $conn->prepare(
    "SELECT *
     FROM students
     WHERE id=?"
);

$stmt->bind_param(
    "i",
    $id
);

$stmt->execute();

$student =
    $stmt->get_result()
    ->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name =
        trim($_POST["name"]);

    $phone =
        trim($_POST["phone"]);

    $course =
        trim($_POST["course"]);

    $stmt = $conn->prepare(
        "UPDATE students
         SET name=?, phone=?, course=?
         WHERE id=?"
    );

    $stmt->bind_param(
        "sssi",
        $name,
        $phone,
        $course,
        $id
    );

    $stmt->execute();

    $_SESSION["student_name"] =
        $name;

    $message =
        "Profile updated successfully.";

    $student["name"] =
        $name;

    $student["phone"] =
        $phone;

    $student["course"] =
        $course;

}

?>

<!DOCTYPE html>

<html>

<head>

<title>Profile</title>

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
Complaints
</a>

<a href="../logout.php">
Logout
</a>

</div>

</nav>

<div class="container narrow">

<div class="panel">

<h1>
My Profile
</h1>

<?php if ($message): ?>

<div class="alert success">

<?= htmlspecialchars($message) ?>

</div>

<?php endif; ?>

<form method="POST">

<div class="form-group">

<label>
Full Name
</label>

<input
name="name"
value="<?= htmlspecialchars($student["name"]) ?>"
required
>

</div>

<div class="form-group">

<label>
Email
</label>

<input
value="<?= htmlspecialchars($student["email"]) ?>"
disabled
>

</div>

<div class="form-group">

<label>
Roll Number
</label>

<input
value="<?= htmlspecialchars($student["roll_no"]) ?>"
disabled
>

</div>

<div class="form-group">

<label>
Phone
</label>

<input
name="phone"
value="<?= htmlspecialchars($student["phone"]) ?>"
>

</div>

<div class="form-group">

<label>
Course
</label>

<input
name="course"
value="<?= htmlspecialchars($student["course"]) ?>"
required
>

</div>

<button
class="btn primary">

Save Changes

</button>

</form>

</div>

</div>

</body>

</html>