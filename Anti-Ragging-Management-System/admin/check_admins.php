
<?php
require_once "../includes/db.php";

$sql = "SELECT id, name, email FROM admins";
$result = $conn->query($sql);

if (!$result) {
    die("Database error: " . $conn->error);
}

echo "<h2>Admin Accounts</h2>";

if ($result->num_rows > 0) {
    echo "<table border='1' cellpadding='10'>";
    echo "<tr><th>ID</th><th>Name</th><th>Email</th></tr>";

    while ($admin = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($admin["id"]) . "</td>";
        echo "<td>" . htmlspecialchars($admin["name"]) . "</td>";
        echo "<td>" . htmlspecialchars($admin["email"]) . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No admin accounts found.";
}

$conn->close();
?>
