
<?php
session_start();
include 'admindb.php'; // Use your admin DB connection file

// Optional: Check if admin is logged in (add login check if needed)
// if (!isset($_SESSION['admin_logged_in'])) {
//     header("Location: adminlogin.php");
//     exit();
// }

// Fetch user login activity
$sql = "
    SELECT u.id, u.first_name, u.last_name, u.email, MAX(l.login_time) AS last_login
    FROM users u
    LEFT JOIN user_logins l ON u.id = l.user_id
    GROUP BY u.id, u.first_name, u.last_name, u.email
    ORDER BY last_login DESC
";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>User Management</title>
  <!--<link rel="stylesheet" href="styles.css"> Link to CSS file, if any -->
  <style>
    /* General Styles */
body {
  margin: 0;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  background-color: #f5f5dc; /* Light beige */
  color: #2e4d2e; /* Deep green text */
}

header {
  background-color: #4CAF50; /* Green header */
  color: white;
  padding: 20px;
  text-align: center;
  font-size: 24px;
}

/* Main Section */
h2 {
  text-align: center;
  color: #2e4d2e;
}

p {
  text-align: center;
  color: #4a4a4a;
}

div {
  max-width: 90%;
  margin: 20px auto;
  padding: 20px;
  background-color: #ffffff;
  border-radius: 12px;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
}

/* Table Styles */
table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
}

th, td {
  padding: 12px 16px;
  text-align: center;
  border-bottom: 1px solid #ddd;
}

th {
  background-color: #a9cfa9; /* Light green header */
  color: #2e4d2e;
  font-weight: bold;
}

tr:nth-child(even) {
  background-color: #f0f0e6; /* Subtle beige for even rows */
}

tr:hover {
  background-color: #e0f7da; /* Very light green on hover */
}

/* Back Button */
a button {
  display: block;
  margin: 30px auto;
  padding: 10px 20px;
  background-color: #4CAF50;
  color: white;
  border: none;
  border-radius: 8px;
  font-size: 16px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

a button:hover {
  background-color: #45a049;
}

    </style>
</head>
<body>
  <header>User Management</header>

  <div>
    <h2>Manage Users</h2>
    <p>Display the user list and manage user actions here.</p>

    <!-- User Activity Table -->
    <table border="1" cellpadding="10" cellspacing="0">
      <thead>
        <tr>
          <th>User ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Last Login</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // Check if the query returned any results
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                echo "<td>" . htmlspecialchars($row['first_name'] . ' ' . $row['last_name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                echo "<td>" . ($row['last_login'] ? $row['last_login'] : 'Never') . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No users found.</td></tr>";
        }
        ?>
      </tbody>
    </table>
  </div>

  <!-- Add a Back Button -->
  <a href="admin.html">
    <button>Back to Dashboard</button>
  </a>

</body>
</html>

<?php
$conn->close();
?>
