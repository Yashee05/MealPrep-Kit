<?php
// Include your database connection
include 'admindb.php';

$message_sent = false;

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);

    if (!empty($name) && !empty($email) && !empty($message)) {
        $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $message);
        $stmt->execute();
        $stmt->close();
        $message_sent = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Contact Us - Meal Prep</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background-color: #f5f5dc; /* Beige */
      color: #2e4d2e; /* Dark green */
    }

    header {
      background-color: #4CAF50;
      color: white;
      padding: 20px 0;
      text-align: center;
    }

    main {
      display: flex;
      justify-content: center;
      padding: 40px 20px;
    }

    .contact-box {
      background-color: #ffffff;
      padding: 30px;
      max-width: 600px;
      width: 100%;
      border-radius: 12px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .contact-box h2 {
      margin-top: 0;
      color: #2e4d2e;
    }

    .contact-box p {
      color: #444;
      margin-bottom: 20px;
    }

    form {
      display: flex;
      flex-direction: column;
    }

    label {
      margin-top: 15px;
      font-weight: bold;
    }

    input, textarea {
      margin-top: 5px;
      padding: 10px;
      font-size: 16px;
      border: 1px solid #ccc;
      border-radius: 8px;
      background-color: #fdfdf8;
    }

    button {
      margin-top: 20px;
      padding: 12px;
      font-size: 16px;
      background-color: #4CAF50;
      color: white;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    button:hover {
      background-color: #45a049;
    }

    .success-message {
      background-color: #d4edda;
      color: #155724;
      border: 1px solid #c3e6cb;
      padding: 10px;
      border-radius: 8px;
      margin-top: 20px;
      text-align: center;
    }

    footer {
      text-align: center;
      padding: 15px;
      background-color: #e0e0c8;
      color: #2e4d2e;
      font-size: 14px;
    }
  </style>
</head>
<body>
  <header>
    <h1>Contact Us</h1>
  </header>

  <main>
    <section class="contact-box">
      <h2>We’d love to hear from you!</h2>
      <p>If you have any questions, feedback, or suggestions, feel free to reach out using the form below.</p>

      <?php if ($message_sent): ?>
        <div class="success-message">Thank you! Your message has been sent successfully.</div>
      <?php endif; ?>

      <form method="POST" action="">
        <label for="name">Your Name</label>
        <input type="text" name="name" id="name" required />

        <label for="email">Your Email</label>
        <input type="email" name="email" id="email" required />

        <label for="message">Your Message</label>
        <textarea name="message" id="message" rows="6" required></textarea>

        <button type="submit">Send Message</button>
      </form>
    </section>
  </main>

  <footer>
    <p>&copy; 2025 Meal Prep. All rights reserved.</p>
  </footer>
</body>
</html>
