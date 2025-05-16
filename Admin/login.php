<?php
include('../config/constants.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
 <style>
    body {
      font-family: Arial, sans-serif;
      background: linear-gradient(to right, #ff6b6b, #f06595);
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
      animation: fadeIn 1.5s ease-in;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(20px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .login-container {
      background: #fff;
      padding: 30px 40px;
      border-radius: 10px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
      width: 320px;
      animation: slideIn 1s ease-out;
    }

    @keyframes slideIn {
      from {
        transform: translateY(-20px);
        opacity: 0;
      }

      to {
        transform: translateY(0);
        opacity: 1;
      }
    }

    .login-container h2 {
      text-align: center;
      margin-bottom: 24px;
      color: #333;
    }

    .login-container label {
      display: block;
      margin-bottom: 6px;
      font-weight: bold;
    }

    .login-container input[type="text"],
    .login-container input[type="password"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 18px;
      border: 1px solid #ccc;
      border-radius: 6px;
      box-sizing: border-box;
    }

    .login-container input[type="submit"] {
      width: 100%;
      padding: 12px;
      background: #FF4757;
      color: #fff;
      border: none;
      border-radius: 6px;
      font-size: 16px;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    .login-container input[type="submit"]:hover {
      background: #c0392b;
    }

    .success {
      color: green;
      font-size: 16px;
      text-align: center;
      margin-bottom: 10px;
    }

    .error {
      color: red;
      font-size: 16px;
      text-align: center;
      margin-bottom: 10px;
    }

    .text-center {
      text-align: center;
      margin-top: 10px;
    }

    .text-center a {
      text-decoration: none;
      color: #FF4757;
    }

    .text-center a:hover {
      text-decoration: underline;
    }
  </style>
</head>

<body>
  <div class="login-container">
    <h2>Login</h2>
    <?php
    //start session
    if (isset($_SESSION['login'])) {
      echo $_SESSION['login'];
      unset($_SESSION['login']);
    }
if (isset($_SESSION['no-login-message'])) {
  echo $_SESSION['no-login-message'];
  unset($_SESSION['no-login-message']);
}
    ?>
    <br>
    <form action="login.php" method="POST">
      <label for="username">Username</label>
      <input type="text" id="username" name="username" placeholder="Enter the username" required>

      <label for="password">Password</label>
      <input type="password" id="password" name="password" required placeholder="Enter the password">

      <input type="submit" name="submit" value="Login">
    </form>
    <p class="text-center">Create by <a href="wwwgoogle.com">Lakshman jha</a></p>
  </div>
</body>

</html>
<?php
//check if the form is submitted
if (isset($_POST['submit'])) {
  //get the username and password data from the form
  $username = $_POST['username'];
  $password = md5($_POST['password']);

  //sql query to check if the username and password are correct
  $sql = "SELECT * FROM tbl_admim  WHERE username='$username' AND password='$password'";
  //execute the query
  $res = mysqli_query($conn, $sql);
  //count the number of rows returned
  $count = mysqli_num_rows($res);

  //if the count is 1, it means the username and password are correct
  if ($count == 1) {
    //set session variables
    $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
    $_SESSION["user"] = $username;// to check wheather the user is logged in or not and logout will unset it,
    //redirect to the index page 
    header('location:' . SITEURL . 'Admin/');
  } else {
    //set session variable for login failed
    $_SESSION['login'] = "<div class='error'>Login Failed. Please try again.</div>";
    //redirect to the login page
    header('location:' . SITEURL . 'Admin/');
  }
}
?>