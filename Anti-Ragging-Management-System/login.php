<?php

session_start();

require_once "includes/db.php";

if (isset($_SESSION['student_id'])) {

    header("Location: student/dashboard.php");
    exit;

}

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email =
        trim($_POST["email"] ?? "");

    $password =
        $_POST["password"] ?? "";

    $stmt = $conn->prepare(
        "SELECT id,name,password
         FROM students
         WHERE email = ?
         LIMIT 1"
    );

    $stmt->bind_param(
        "s",
        $email
    );

    $stmt->execute();

    $result =
        $stmt->get_result();

    $student =
        $result->fetch_assoc();

    if (
        $student &&
        password_verify(
            $password,
            $student["password"]
        )
    ) {

        session_regenerate_id(true);

        $_SESSION["student_id"] =
            $student["id"];

        $_SESSION["student_name"] =
            $student["name"];

        header(
            "Location: student/dashboard.php"
        );

        exit;

    }

    $error =
        "Invalid email or password.";

}

?>

<!DOCTYPE html>

<html>

<head>

<title>Student Login</title>

<link rel="stylesheet"
href="assets/css/style.css">

</head>

<body class="auth-body">

<div class="auth-card small">

<a href="index.php"
class="back">
← Back to Home
</a>

<div class="logo small-logo">
AR
</div>

<h1>
Student Login
</h1>

<p class="muted">
Access your complaint dashboard.
</p>

<?php if ($error): ?>

<div class="alert error">

<?= htmlspecialchars($error) ?>

</div>

<?php endif; ?>

<?php if (isset($_GET["registered"])): ?>

<div class="alert success">

Registration successful.
You can now login.

</div>

<?php endif; ?>

<form method="POST">

<div class="form-group">

<label>Email</label>

<input
type="email"
name="email"
required
>

</div>

<div class="form-group">

<label>Password</label>

<input
type="password"
name="password"
required
>

</div>

<button
class="btn primary full">

Login

</button>

</form>

<p class="center muted">

Don't have an account?

<a href="register.php">
Register
</a>

</p>

</div>

</body>

</html>