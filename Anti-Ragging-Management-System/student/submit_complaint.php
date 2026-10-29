<?php

require_once "../includes/student_auth.php";
require_once "../includes/db.php";

$errors = [];
$success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $title =
        trim($_POST["title"] ?? "");

    $description =
        trim($_POST["description"] ?? "");

    $incident_date =
        $_POST["incident_date"] ?? "";

    $incident_time =
        $_POST["incident_time"] ?? "";

    $location =
        trim($_POST["location"] ?? "");

    $accused_name =
        trim($_POST["accused_name"] ?? "");

    $witness_details =
        trim($_POST["witness_details"] ?? "");

    if ($title === "") {

        $errors[] =
            "Complaint title is required.";

    }

    if (strlen($description) < 20) {

        $errors[] =
            "Description must contain at least 20 characters.";

    }

    if ($incident_date === "") {

        $errors[] =
            "Incident date is required.";

    }

    if ($location === "") {

        $errors[] =
            "Incident location is required.";

    }

    $evidence = null;

    if (
        isset($_FILES["evidence"]) &&
        $_FILES["evidence"]["error"] !== UPLOAD_ERR_NO_FILE
    ) {

        if (
            $_FILES["evidence"]["error"]
            !== UPLOAD_ERR_OK
        ) {

            $errors[] =
                "Evidence upload failed.";

        } elseif (
            $_FILES["evidence"]["size"]
            > 5 * 1024 * 1024
        ) {

            $errors[] =
                "Evidence file must be less than 5 MB.";

        } else {

            $allowed =
                ["jpg","jpeg","png","pdf"];

            $extension =
                strtolower(
                    pathinfo(
                        $_FILES["evidence"]["name"],
                        PATHINFO_EXTENSION
                    )
                );

            if (
                !in_array(
                    $extension,
                    $allowed
                )
            ) {

                $errors[] =
                    "Only JPG, JPEG, PNG and PDF files are allowed.";

            } else {

                $evidence =
                    bin2hex(
                        random_bytes(16)
                    )
                    . "."
                    . $extension;

            }

        }

    }

    if (empty($errors)) {

        if ($evidence !== null) {

            $upload_dir =
                __DIR__ .
                "/../uploads/complaints/";

            if (!is_dir($upload_dir)) {

                mkdir(
                    $upload_dir,
                    0775,
                    true
                );

            }

            move_uploaded_file(
                $_FILES["evidence"]["tmp_name"],
                $upload_dir . $evidence
            );

        }

        $stmt = $conn->prepare(
            "INSERT INTO complaints
            (
                student_id,
                title,
                description,
                incident_date,
                incident_time,
                location,
                accused_name,
                witness_details,
                evidence
            )
            VALUES (?,?,?,?,?,?,?,?,?)"
        );

        $stmt->bind_param(
            "issssssss",
            $_SESSION["student_id"],
            $title,
            $description,
            $incident_date,
            $incident_time,
            $location,
            $accused_name,
            $witness_details,
            $evidence
        );

        $stmt->execute();

        $complaint_id =
            $conn->insert_id;

        $message =
            "Your complaint #"
            . $complaint_id
            . " has been submitted successfully.";

        $notification =
            $conn->prepare(
                "INSERT INTO notifications
                (student_id,complaint_id,message)
                VALUES (?,?,?)"
            );

        $notification->bind_param(
            "iis",
            $_SESSION["student_id"],
            $complaint_id,
            $message
        );

        /*
        Note:
        The above line intentionally uses the correct
        integer/string binding below.
        */

        $notification->bind_param(
            "iis",
            $_SESSION["student_id"],
            $complaint_id,
            $message
        );

        $notification->close();

        $success =
            "Complaint #"
            . $complaint_id
            . " submitted successfully.";

    }

}

?>

<!DOCTYPE html>

<html>

<head>

<title>Report Complaint</title>

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

<h1>
Report Ragging Incident
</h1>

<p class="muted">

Your complaint will be handled confidentially.

</p>

<?php if ($errors): ?>

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

<?php if ($success): ?>

<div class="alert success">

<?= htmlspecialchars($success) ?>

<br><br>

<a href="my_complaints.php">
View My Complaints
</a>

</div>

<?php endif; ?>

<form
method="POST"
enctype="multipart/form-data">

<div class="form-group">

<label>
Complaint Title *
</label>

<input
type="text"
name="title"
placeholder="Example: Verbal harassment by senior students"
required
>

</div>

<div class="two-column">

<div class="form-group">

<label>
Incident Date *
</label>

<input
type="date"
name="incident_date"
required
>

</div>

<div class="form-group">

<label>
Incident Time
</label>

<input
type="time"
name="incident_time"
>

</div>

</div>

<div class="form-group">

<label>
Incident Location *
</label>

<input
type="text"
name="location"
placeholder="Example: College Canteen"
required
>

</div>

<div class="form-group">

<label>
Person(s) Involved
</label>

<input
type="text"
name="accused_name"
placeholder="Name if known"
>

</div>

<div class="form-group">

<label>
Description *
</label>

<textarea
name="description"
rows="7"
minlength="20"
placeholder="Explain what happened in detail..."
required></textarea>

</div>

<div class="form-group">

<label>
Witness Details
</label>

<textarea
name="witness_details"
rows="4"
placeholder="Enter witness information if applicable"></textarea>

</div>

<div class="form-group">

<label>
Supporting Evidence
</label>

<input
type="file"
name="evidence"
accept=".jpg,.jpeg,.png,.pdf"
>

<small>
Maximum 5 MB.
JPG, JPEG, PNG and PDF allowed.
</small>

</div>

<button
type="submit"
class="btn primary">

Submit Confidential Complaint

</button>

<a
href="dashboard.php"
class="btn secondary">

Cancel

</a>

</form>

</div>

</div>

</body>

</html>