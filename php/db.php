<?php
// Database connection variables for user side
$host = "localhost";  // Database server name
$user = "root";       // Default MySQL username in XAMPP
$password = "";       // Default MySQL password in XAMPP (empty)
$database = "payments";  // Database name (make sure it's the same as the admin side)

$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
