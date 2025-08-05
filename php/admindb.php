<?php
// Database connection variables for admin side
$servername = "localhost";  // Database server name (usually 'localhost')
$username = "root";         // Default MySQL username in XAMPP
$password = "";             // Default MySQL password in XAMPP (empty)
$dbname = "payment";        // Correct database name here (change from 'payments' to 'payment')

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
