<?php
include 'admindb.php'; // Your DB connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $desc = $_POST['description'];
    $ingredients = $_POST['ingredients'];
    $instructions = $_POST['instructions'];
    $price = $_POST['price'];

    // Handle image upload
    $image = '';
    if ($_FILES['image']['name']) {
        $image = 'uploads/' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $image);
    }

    $stmt = $conn->prepare("INSERT INTO recipes (name, description, ingredients, instructions, price, image) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssds", $name, $desc, $ingredients, $instructions, $price, $image);
    $stmt->execute();

    header("Location: admin_recipes.html");
}
?>
