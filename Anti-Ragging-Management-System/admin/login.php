<?php

session_start();

require_once "../includes/db.php";

if (isset($_SESSION["admin_id"])) {

    header("Location: dashboard.php");
    exit;

}

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email =
        trim($_POST["email"]);

    $password =
        $_POST["password"];

    $stmt = $conn->prepare(
        "SELECT id,name,password
         FROM admins
         WHERE email=?
         LIMIT 1"
    );

    $stmt->bind_param(
        "s",
        $email
    );

    $stmt->execute();

    $admin =
        $stmt->get_result()
        ->fetch_assoc();

    if (
        $admin &&
        password_verify(
            $password,
            $admin["password"]
        )
    ) {

        session_regenerate_id(true);

        $_SESSION["admin_id"] =
            $admin["id"];

        $_SESSION["admin_name"] =
            $admin["name"];

        header(
            "Location: dashboard.php"
        );

        exit;

    }

    $error =
        "Invalid admin email or password.";

}

?>

<!DOCTYPE html>

<html>

<head>

<title>Admin Login</title>

<link rel="stylesheet"
href="../assets/css/style.css">

</head>

<body class="auth-body">

<div class="auth-card small">

<a href="../index.php"
class="back">

← Home

</a>

<div class="logo small-logo">
AR
</div>

<h1>
Admin Portal
</h1>

<p class="muted">
Authorized staff access only.
</p>

<?php if ($error): ?>

<div class="alert error">

<?= htmlspecialchars($error) ?>

</div>

<?php endif; ?>

<form method="POST">

<div class="form-group">

<label>
Email
</label>

<input
type="email"
name="email"
required
>

</div>

<div class="form-group">

<label>
Password
</label>

<input
type="password"
name="password"
required
>

</div>

<button
class="btn dark full">

Admin Login

</button>

</form>

</div>

</body>

</html>