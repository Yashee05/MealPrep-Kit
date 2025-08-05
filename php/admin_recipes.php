<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Recipe Management</title>

  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f6f9;
      margin: 0;
      padding: 20px;
    }

    h1 {
      text-align: center;
      color: #333;
      margin-bottom: 30px;
    }

    .container {
      max-width: 900px;
      margin: 0 auto;
      background-color: #fff;
      padding: 30px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      border-radius: 10px;
    }

    form {
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    input[type="text"],
    input[type="number"],
    textarea,
    input[type="file"] {
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 6px;
      width: 100%;
      font-size: 14px;
    }

    button {
      background-color: #28a745;
      color: #fff;
      padding: 10px;
      font-size: 16px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    button:hover {
      background-color: #218838;
    }

    .recipe-list {
      margin-top: 40px;
    }

    .recipe-card {
      border: 1px solid #ddd;
      border-radius: 8px;
      padding: 15px;
      margin-bottom: 20px;
      background-color: #fafafa;
    }

    .recipe-card img {
      max-width: 150px;
      border-radius: 8px;
      margin-bottom: 10px;
    }

    .delete-form {
      margin-top: 10px;
    }

    .delete-form button {
      background-color: #dc3545;
    }

    .delete-form button:hover {
      background-color: #c82333;
    }
  </style>
</head>

<body>
  <h1>MANAGE RECIPIES</h1>

  <!-- Add New Recipe -->
  <form action="add_recipe.php" method="POST" enctype="multipart/form-data">
    <input type="text" name="name" placeholder="Recipe Name" required><br>
    <textarea name="description" placeholder="Description"></textarea><br>
    <textarea name="ingredients" placeholder="Ingredients (comma separated)"></textarea><br>
    <textarea name="instructions" placeholder="Instructions"></textarea><br>
    <input type="number" step="0.01" name="price" placeholder="Price" required><br>
    <input type="file" name="image" accept="image/*"><br>
    <button type="submit">Add Recipe</button>
  </form>

  <hr>

  <!-- Display Recipes -->
  <?php include 'display_recipies.php'; ?>
</body>
</html>
