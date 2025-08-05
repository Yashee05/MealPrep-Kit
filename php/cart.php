<?php
// Connect to database
$conn = new mysqli("localhost", "root", "", "payment");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Remove item if delete button clicked
if (isset($_POST['delete'])) {
    $recipe = $_POST['recipe'];
    $conn->query("DELETE FROM `add to cart` WHERE recipe = '$recipe'");
}

// Update quantity if plus or minus button clicked
if (isset($_POST['update'])) {
    $recipe = $_POST['recipe'];
    $quantity = $_POST['quantity'];

    if ($quantity <= 0) {
        // Remove if quantity is zero or less
        $conn->query("DELETE FROM `add to cart` WHERE recipe = '$recipe'");
    } else {
        $conn->query("UPDATE `add to cart` SET quantity = $quantity WHERE recipe = '$recipe'");
    }
}

// Fetch cart items
$sql = "SELECT * FROM `add to cart`";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Cart</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: url('https://images.unsplash.com/photo-1600891964599-f61ba0e24092?auto=format&fit=crop&w=1950&q=80') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
        }
        .overlay {
            background-color: rgba(245, 245, 220, 0.9);
            min-height: 100vh;
            padding: 40px 20px;
        }
        .cart-container {
            max-width: 900px;
            margin: auto;
            background: #ffffff;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
        }
        h2 {
            text-align: center;
            color: #28a745;
            margin-bottom: 30px;
        }
        .cart-item {
            background: #f5f5dc;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: transform 0.2s;
        }
        .cart-item:hover {
            transform: scale(1.02);
        }
        .item-info {
            flex: 1;
        }
        .item-name {
            font-weight: bold;
            font-size: 20px;
            color: #333;
            margin-bottom: 8px;
        }
        .item-price, .item-total {
            font-size: 15px;
            color: #666;
        }
        .quantity-control {
            display: flex;
            align-items: center;
        }
        .quantity-control form {
            display: inline-block;
        }
        .quantity-control button {
            padding: 8px 12px;
            margin: 0 5px;
            font-size: 18px;
            cursor: pointer;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 8px;
            transition: background-color 0.3s;
        }
        .quantity-control button:hover {
            background-color: #218838;
        }
        .quantity {
            font-size: 16px;
            width: 30px;
            text-align: center;
        }
        .remove-btn {
            background-color: red;
            margin-left: 10px;
        }
        .remove-btn:hover {
            background-color: darkred;
        }
        .grand-total {
            text-align: right;
            font-size: 22px;
            font-weight: bold;
            color: #28a745;
            margin-top: 20px;
        }
        .confirm-order {
            width: 100%;
            padding: 18px;
            margin-top: 25px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 15px;
            font-size: 20px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.4s, transform 0.2s;
        }
        .confirm-order:hover {
            background-color: #218838;
            transform: scale(1.02);
        }
    </style>
</head>
<body>

<div class="overlay">
    <div class="cart-container">
        <h2>🛒 My Cart</h2>

        <?php if ($result->num_rows > 0): ?>
            <?php $grandTotal = 0; ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <?php $itemTotal = $row['price'] * $row['quantity']; ?>
                <?php $grandTotal += $itemTotal; ?>
                <div class="cart-item">
                    <div class="item-info">
                        <div class="item-name"><?php echo htmlspecialchars($row['recipe']); ?></div>
                        <div class="item-price">Unit Price: Rs<?php echo $row['price']; ?></div>
                        <div class="item-total">Total: Rs<?php echo $itemTotal; ?></div>
                    </div>
                    <div class="quantity-control">
                        <form method="post" style="display:inline;">
                            <input type="hidden" name="recipe" value="<?php echo htmlspecialchars($row['recipe']); ?>">
                            <input type="hidden" name="quantity" value="<?php echo $row['quantity'] - 1; ?>">
                            <button type="submit" name="update">-</button>
                        </form>

                        <span class="quantity"><?php echo $row['quantity']; ?></span>

                        <form method="post" style="display:inline;">
                            <input type="hidden" name="recipe" value="<?php echo htmlspecialchars($row['recipe']); ?>">
                            <input type="hidden" name="quantity" value="<?php echo $row['quantity'] + 1; ?>">
                            <button type="submit" name="update">+</button>
                        </form>

                        <form method="post" style="display:inline;">
                            <input type="hidden" name="recipe" value="<?php echo htmlspecialchars($row['recipe']); ?>">
                            <button type="submit" name="delete" class="remove-btn">Remove</button>
                        </form>
                    </div>
                </div>
            <?php endwhile; ?>

            <div class="grand-total">Grand Total: Rs<?php echo $grandTotal; ?></div>

            <button class="confirm-order" onclick="confirmOrder()">Confirm Order</button>

        <?php else: ?>
            <p style="text-align:center;">Your cart is empty!</p>
        <?php endif; ?>

    </div>
</div>

<script>
function confirmOrder() {
    alert('✅ Order Confirmed!\nThank you for your purchase!');
}
</script>

</body>
</html>
