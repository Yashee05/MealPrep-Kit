<?php
// Include database connection
include 'admindb.php';

// Check if form is submitted
if (isset($_POST['item_id']) && isset($_POST['quantity'])) {
    $item_id = intval($_POST['item_id']);
    $quantity = intval($_POST['quantity']);

    // Update the quantity in the database
    $updateQuery = "UPDATE `add to cart` SET quantity = $quantity WHERE item_id = $item_id";

    if (mysqli_query($conn, $updateQuery)) {
        // Redirect back to admin_cart.php after update
        header("Location: admin_cart.php");
        exit();
    } else {
        echo "Error updating quantity: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request.";
}
?>
