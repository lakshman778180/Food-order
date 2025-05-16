<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f4f4;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .register-container {
      background: #fff;
      padding: 30px 40px;
      border-radius: 8px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      width: 340px;
    }
    .register-container h2 {
      text-align: center;
      margin-bottom: 24px;
    }
    .register-container label {
      display: block;
      margin-bottom: 6px;
      font-weight: bold;
    }
    .register-container input[type="text"],
    .register-container input[type="password"],
    .register-container input[type="email"] {
      width: 100%;
      padding: 8px;
      margin-bottom: 18px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    .register-container button {
      width: 100%;
      padding: 10px;
      background: #007bff;
      color: #fff;
      border: none;
      border-radius: 4px;
      font-size: 16px;
      cursor: pointer;
    }
    .register-container button:hover {
      background: #0056b3;
    }
    .register-container p {
      text-align: center;
      margin-top: 16px;
    }
  </style>
</head>
<body>
  <div class="register-container">
    <h2>Register</h2>
    <form action="register.php" method="POST">
      <label for="username">Username</label>
      <input type="text" id="username" name="username" required>

      <label for="email">Email</label>
      <input type="email" id="email" name="email" required>

      <label for="password">Password</label>
      <input type="password" id="password" name="password" required>

      <label for="confirm_password">Confirm Password</label>
      <input type="password" id="confirm_password" name="confirm_password" required>

      <button type="submit">Register</button>
    </form>
    <p>
      Already have an account?
      <a href="login.html">Login</a>
    </p>
  </div>
</body>
</html>
