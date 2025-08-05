<?php
// Include your database connection
include 'admindb.php';

// Check if the 'id' parameter is set in the URL
if (isset($_GET['id'])) {
    $item_id = intval($_GET['id']); // Make sure it's a safe number

    // SQL query to delete the item
    $deleteQuery = "DELETE FROM `add to cart` WHERE item_id = $item_id";

    if (mysqli_query($conn, $deleteQuery)) {
        // If delete successful, redirect back with success message
        header("Location: admin_cart.php?deleted=1");
        exit();
    } else {
        echo "Error deleting item: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request: No item ID provided.";
}

// Close database connection
mysqli_close($conn);
?>
