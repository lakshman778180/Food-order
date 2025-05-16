
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f4f4;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .contact-container {
      background: #fff;
      padding: 30px 40px;
      border-radius: 8px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      width: 360px;
    }
    .contact-container h2 {
      text-align: center;
      margin-bottom: 24px;
    }
    .contact-container label {
      display: block;
      margin-bottom: 6px;
      font-weight: bold;
    }
    .contact-container input[type="text"],
    .contact-container input[type="email"],
    .contact-container textarea {
      width: 100%;
      padding: 8px;
      margin-bottom: 18px;
      border: 1px solid #ccc;
      border-radius: 4px;
      font-family: inherit;
      font-size: 15px;
    }
    .contact-container textarea {
      resize: vertical;
      min-height: 80px;
      max-height: 200px;
    }
    .contact-container button {
      width: 100%;
      padding: 10px;
      background: #FF4757;
      color: #fff;
      border: none;
      border-radius: 4px;
      font-size: 16px;
      cursor: pointer;
    }
    .contact-container button:hover {
      background: #764145;
    }
  </style>
</head>
<body>
  <div class="contact-container">
    <h2>Contact Us</h2>
    <form action="contact_process.php" method="POST">
      <label for="name">Your Name</label>
      <input type="text" id="name" name="name" required>

      <label for="email">Your Email</label>
      <input type="email" id="email" name="email" required>

      <label for="message">Message</label>
      <textarea id="message" name="message" required></textarea>

      <button type="submit">Send Message</button>
    </form>
  </div>
</body>
</html>