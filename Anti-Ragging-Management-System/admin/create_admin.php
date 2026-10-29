<?php

require_once "../includes/db.php";

$name = "Administrator";
$email = "admin@antiragging.com";
$password = "admin123";

$hash = password_hash($password, PASSWORD_DEFAULT);

// Check whether the admin already exists
$check = $conn->prepare(
    "SELECT id FROM admins WHERE email = ?"
);

$check->bind_param("s", $email);
$check->execute();

$result = $check->get_result();

if ($result->num_rows > 0) {

    echo "<h2>ADMIN ACCOUNT ALREADY EXISTS</h2>";
    echo "<p>Email: admin@antiragging.com</p>";
    echo '<p><a href="login.php">Go to Admin Login</a></p>';

} else {

    $stmt = $conn->prepare(
        "INSERT INTO admins (name, email, password)
         VALUES (?, ?, ?)"
    );

    $stmt->bind_param("sss", $name, $email, $hash);

    if ($stmt->execute()) {

        echo "<h2>ADMIN CREATED SUCCESSFULLY</h2>";
        echo "<p>Email: admin@antiragging.com</p>";
        echo "<p>Password: admin123</p>";
        echo '<p><a href="login.php">Go to Admin Login</a></p>';

    } else {

        echo "Error creating admin: " . $stmt->error;

    }

    $stmt->close();
}

$check->close();
$conn->close();

?>
