<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/admin.css">
  <title>Food order Website </title>
    
</head>
<body>
 <?php include('partial/menu.php'); ?>
  <!-- main content start  -->

<div class="header">Dashboard</div>
<br>
  <?php
    //start session
        if(isset($_SESSION['login'])) {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }
        
    ?>


  <div class="main_content">
    <div class="card">
      <h2>5</h2>
      <p>Manage food categories.</p>
      <a href="../Admin/login.php">Go to Categories</a>
  </div>
     <div class="card">
      <h2>5</h2>
      <p>Manage food categories.</p>
      <a href="../Admin/login.php">Go to Categories</a>
  </div>
     <div class="card">
      <h2>5</h2>
      <p>Manage food categories.</p>
      <a href="../Admin/login.php">Go to Categories</a>
  </div>
     <div class="card">
      <h2>5</h2>
      <p>Manage food categories.</p>
      <a href="../Admin/login.php">Go to Categories</a>
  </div>
    <div class="card">
      <h2>5</h2>
      <p>Manage food categories.</p>
      <a href="../Admin/login.php">Go to Categories</a>
  </div>
  </div>
  <!-- main content end  -->
   <!-- footer is start  -->
<?php include('partial/footer.php'); ?>
  <!-- footer is end  -->
</body>
</html>