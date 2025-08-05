<?php
// Include your database connection
include 'admindb.php';

// Show success message if item deleted
if (isset($_GET['deleted']) && $_GET['deleted'] == 1) {
    echo "<script>alert('Item deleted successfully!');</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Cart</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f2f2f2;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        a.delete-button {
            background-color: #e74c3c;
            color: white;
            padding: 8px 12px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
        }

        a.delete-button:hover {
            background-color: #c0392b;
        }

        .no-items {
            text-align: center;
            font-size: 18px;
            color: #555;
            margin-top: 50px;
        }
    </style>
</head>
<body>

<h1>Admin Cart Details</h1>

<?php
// SQL query to fetch all items from the 'add to cart' table
$query = "SELECT * FROM `add to cart`";
$result = mysqli_query($conn, $query);

// Check if there are any rows in the result
if (mysqli_num_rows($result) > 0) {
    echo "<table>";
    echo "<tr><th>Recipe</th><th>Quantity</th><th>Price</th><th>Action</th></tr>";

    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row["recipe"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["quantity"]) . "</td>";
        echo "<td>₹" . htmlspecialchars($row["price"]) . "</td>";
        echo "<td><a href='delete_item.php?id=" . $row["item_id"] . "' class='delete-button' onclick=\"return confirm('Are you sure you want to delete this item?');\">Delete</a></td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "<div class='no-items'>No items found in the admin cart.</div>";
}

// Close the database connection
mysqli_close($conn);
?>

</body>
</html>
