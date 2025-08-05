<?php
// Connect to the database
$conn = new mysqli("localhost", "root", "", "payment");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $recipe = $_POST['recipe'];
    $quantity = intval($_POST['quantity']);
    $price = floatval($_POST['price']);

    // Check if item already exists in cart
    $check = $conn->prepare("SELECT quantity FROM `add to cart` WHERE recipe = ?");
    $check->bind_param("s", $recipe);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        // Item exists, update quantity
        $check->bind_result($existingQuantity);
        $check->fetch();
        $newQuantity = $existingQuantity + $quantity;

        $update = $conn->prepare("UPDATE `add to cart` SET quantity = ? WHERE recipe = ?");
        $update->bind_param("is", $newQuantity, $recipe);
        $update->execute();
    } else {
        // Insert new item
        $stmt = $conn->prepare("INSERT INTO `add to cart` (recipe, quantity, price) VALUES (?, ?, ?)");
        $stmt->bind_param("sid", $recipe, $quantity, $price);
        $stmt->execute();
    }

    echo "Added successfully";
}
?>
