<?php
// Database connection
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "payment"; 

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if both fields are filled
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Prepare and bind
        $stmt = $conn->prepare("SELECT password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        // Check if user exists
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($hashed_password);
            $stmt->fetch();

            // Verify the password
            if (password_verify($password, $hashed_password)) {
                // Redirect to home page after successful login
                header("Location: home.html");
                exit();
            } else {
                // Invalid password
                header("Location: login.html?error=Invalid password.");
                exit();
            }
        } else {
            // No user found with that email
            header("Location: login.html?error=No user found with that email.");
            exit();
        }

        $stmt->close();
    } else {
        // Missing email or password
        header("Location: login.html?error=Please fill both email and password.");
        exit();
    }
}

$conn->close();
?>
