<?php
// Enable full error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$servername = "localhost";
$username = "root";
$password = ""; // Default password for XAMPP
$database = "payment"; // Database name

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process login form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Ensure expected fields are set
    if (!empty($_POST['admin_username']) && !empty($_POST['admin_password'])) {
        $admin_username = $conn->real_escape_string($_POST['admin_username']);
        $admin_password = $conn->real_escape_string($_POST['admin_password']);

        // Run the query safely
        $sql = "SELECT * FROM admin_login WHERE username = '$admin_username' AND password = '$admin_password'";
        $result = $conn->query($sql);

        // Check for query error
        if (!$result) {
            die("Query failed: " . $conn->error);
        }

        // Check if login is valid
        if ($result->num_rows > 0) {
            header("Location: admin.html");
            exit();
        } else {
            echo "<script>
                    alert('Invalid Username or Password');
                    window.location.href='admin_login.html';
                  </script>";
            exit();
        }
    } else {
        echo "<script>
                alert('Please fill in both username and password.');
                window.location.href='admin_login.html';
              </script>";
        exit();
    }
}

// Close connection
$conn->close();
?>
