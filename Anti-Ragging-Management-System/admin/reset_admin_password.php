
<?php
require_once "../includes/db.php";

$email = "admin@antiragging.com";
$newPassword = "admin123";
$hash = password_hash($newPassword, PASSWORD_DEFAULT);

$stmt = $conn->prepare(
    "UPDATE admins SET password = ? WHERE email = ?"
);

$stmt->bind_param("ss", $hash, $email);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo "Admin password reset successfully.";
} else {
    echo "No password change made. The admin may not exist, or the password was already the same.";
}

$stmt->close();
$conn->close();
?>
