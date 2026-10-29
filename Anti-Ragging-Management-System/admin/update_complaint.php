<?php

require_once "../includes/admin_auth.php";
require_once "../includes/db.php";

$id =
    intval($_GET["id"] ?? 0);

$stmt = $conn->prepare(
    "SELECT *
     FROM complaints
     WHERE id=?"
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

    die("Complaint not found.");

}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $new_status =
        $_POST["status"];

    $remarks =
        trim($_POST["remarks"]);

    $old_status =
        $complaint["status"];

    $stmt = $conn->prepare(
        "UPDATE complaints
         SET status=?,
             admin_remarks=?
         WHERE id=?"
    );

    $stmt->bind_param(
        "ssi",
        $new_status,
        $remarks,
        $id
    );

    $stmt->execute();

    /*
    Save status history
    */

    if ($old_status !== $new_status) {

        $history =
            $conn->prepare(
                "INSERT INTO
                complaint_status_history
                (
                    complaint_id,
                    old_status,
                    new_status,
                    remarks,
                    changed_by
                )
                VALUES (?,?,?,?,?)"
            );

        $history->bind_param(
            "isssi",
            $id,
            $old_status,
            $new_status,
            $remarks,
            $_SESSION["admin_id"]
        );

        $history->execute();

    }

    /*
    Notify student
    */

    $message =
        "Your complaint #"
        . $id
        . " status has been updated to "
        . $new_status
        . ".";

    $notification =
        $conn->prepare(
            "INSERT INTO notifications
            (student_id,complaint_id,message)
            VALUES (?,?,?)"
        );

    $notification->bind_param(
        "iis",
        $complaint["student_id"],
        $id,
        $message
    );

    $notification->execute();

    header(
        "Location: complaints.php"
    );

    exit;

}

?>

<!DOCTYPE html>

<html>

<head>

<title>
Update Complaint
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

<a href="logout.php">
Logout
</a>

</div>

</nav>

<div class="container narrow">

<div class="panel">

<h1>
Update Complaint #<?= $id ?>
</h1>

<h3>
<?= htmlspecialchars(
$complaint["title"]
) ?>
</h3>

<form method="POST">

<div class="form-group">

<label>
Complaint Status
</label>

<select name="status">

<option
<?= $complaint["status"] === "Pending"
? "selected"
: "" ?>>

Pending

</option>

<option
<?= $complaint["status"] === "Under Investigation"
? "selected"
: "" ?>>

Under Investigation

</option>

<option
<?= $complaint["status"] === "Resolved"
? "selected"
: "" ?>>

Resolved

</option>

<option
<?= $complaint["status"] === "Rejected"
? "selected"
: "" ?>>

Rejected

</option>

</select>

</div>

<div class="form-group">

<label>
Admin Remarks
</label>

<textarea
name="remarks"
rows="7"
placeholder="Enter investigation/update remarks..."><?= htmlspecialchars(
$complaint["admin_remarks"] ?? ""
) ?></textarea>

</div>

<button
class="btn primary">

Save Update

</button>

<a
href="complaints.php"
class="btn secondary">

Cancel

</a>

</form>

</div>

</div>

</body>

</html>