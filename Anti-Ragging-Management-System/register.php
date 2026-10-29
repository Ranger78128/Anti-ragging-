<?php

session_start();

require_once "includes/db.php";

if (isset($_SESSION['student_id'])) {

    header("Location: student/dashboard.php");
    exit;

}

$errors = [];

$name = "";
$email = "";
$phone = "";
$course = "";
$roll_no = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $phone = trim($_POST["phone"] ?? "");
    $course = trim($_POST["course"] ?? "");
    $roll_no = trim($_POST["roll_no"] ?? "");

    $password = $_POST["password"] ?? "";
    $confirm_password = $_POST["confirm_password"] ?? "";

    /*
    --------------------------------
    VALIDATION
    --------------------------------
    */

    if ($name === "") {

        $errors[] = "Full name is required.";

    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $errors[] = "Please enter a valid email address.";

    }

    if ($phone !== "" &&
        !preg_match("/^[0-9]{10}$/", $phone)) {

        $errors[] =
            "Phone number must contain exactly 10 digits.";

    }

    if ($course === "") {

        $errors[] = "Course/Class is required.";

    }

    if ($roll_no === "") {

        $errors[] = "Roll number is required.";

    }

    if (strlen($password) < 8) {

        $errors[] =
            "Password must contain at least 8 characters.";

    }

    if (!preg_match("/[A-Za-z]/", $password)) {

        $errors[] =
            "Password must contain at least one letter.";

    }

    if (!preg_match("/[0-9]/", $password)) {

        $errors[] =
            "Password must contain at least one number.";

    }

    if ($password !== $confirm_password) {

        $errors[] =
            "Passwords do not match.";

    }

    if (!isset($_POST["terms"])) {

        $errors[] =
            "You must accept the terms and confidentiality statement.";

    }

    /*
    --------------------------------
    CHECK DUPLICATE
    --------------------------------
    */

    if (empty($errors)) {

        $check = $conn->prepare(
            "SELECT id
             FROM students
             WHERE email = ?
             OR roll_no = ?
             LIMIT 1"
        );

        $check->bind_param(
            "ss",
            $email,
            $roll_no
        );

        $check->execute();

        $result = $check->get_result();

        if ($result->num_rows > 0) {

            $errors[] =
                "Email or roll number is already registered.";

        }

    }

    /*
    --------------------------------
    INSERT STUDENT
    --------------------------------
    */

    if (empty($errors)) {

        $hashed_password =
            password_hash(
                $password,
                PASSWORD_DEFAULT
            );

        $stmt = $conn->prepare(
            "INSERT INTO students
            (name,email,password,phone,course,roll_no)
            VALUES (?,?,?,?,?,?)"
        );

        $stmt->bind_param(
            "ssssss",
            $name,
            $email,
            $hashed_password,
            $phone,
            $course,
            $roll_no
        );

        if ($stmt->execute()) {

            header(
                "Location: login.php?registered=1"
            );

            exit;

        } else {

            $errors[] =
                "Registration failed. Please try again.";

        }

    }

}

?>

<!DOCTYPE html>

<html>

<head>

    <title>Student Registration</title>

    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <link rel="stylesheet"
          href="assets/css/style.css">

</head>

<body class="auth-body">

<div class="auth-card">

    <a href="index.php"
       class="back">
       ← Back to Home
    </a>

    <div class="logo small-logo">
        AR
    </div>

    <h1>
        Create Student Account
    </h1>

    <p class="muted">
        Register to securely report and track complaints.
    </p>

    <?php if (!empty($errors)): ?>

        <div class="alert error">

            <ul>

            <?php foreach ($errors as $error): ?>

                <li>
                    <?= htmlspecialchars($error) ?>
                </li>

            <?php endforeach; ?>

            </ul>

        </div>

    <?php endif; ?>

    <form method="POST">

        <div class="two-column">

            <div class="form-group">

                <label>
                    Full Name *
                </label>

                <input
                    type="text"
                    name="name"
                    value="<?= htmlspecialchars($name) ?>"
                    required
                >

            </div>

            <div class="form-group">

                <label>
                    Roll Number *
                </label>

                <input
                    type="text"
                    name="roll_no"
                    value="<?= htmlspecialchars($roll_no) ?>"
                    required
                >

            </div>

        </div>

        <div class="form-group">

            <label>
                Email Address *
            </label>

            <input
                type="email"
                name="email"
                value="<?= htmlspecialchars($email) ?>"
                required
            >

        </div>

        <div class="two-column">

            <div class="form-group">

                <label>
                    Phone Number
                </label>

                <input
                    type="text"
                    name="phone"
                    maxlength="10"
                    value="<?= htmlspecialchars($phone) ?>"
                    placeholder="10 digit number"
                >

            </div>

            <div class="form-group">

                <label>
                    Course / Class *
                </label>

                <input
                    type="text"
                    name="course"
                    value="<?= htmlspecialchars($course) ?>"
                    placeholder="Example: TYCS"
                    required
                >

            </div>

        </div>

        <div class="two-column">

            <div class="form-group">

                <label>
                    Password *
                </label>

                <input
                    type="password"
                    name="password"
                    minlength="8"
                    required
                >

            </div>

            <div class="form-group">

                <label>
                    Confirm Password *
                </label>

                <input
                    type="password"
                    name="confirm_password"
                    minlength="8"
                    required
                >

            </div>

        </div>

        <div class="password-info">

            Password must contain:

            <br>

            ✓ Minimum 8 characters

            <br>

            ✓ At least one letter

            <br>

            ✓ At least one number

        </div>

        <label class="checkbox">

            <input
                type="checkbox"
                name="terms"
                required
            >

            I agree to use this system responsibly
            and understand that complaint information
            will be handled confidentially.

        </label>

        <button
            type="submit"
            class="btn primary full">
            Create Account
        </button>

    </form>

    <p class="center muted">

        Already have an account?

        <a href="login.php">
            Login here
        </a>

    </p>

</div>

</body>

</html>