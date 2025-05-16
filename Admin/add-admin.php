<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/admin.css">
  <title>Add-admin</title>
<style>
  table{
    /* width: 20%; */
    border-collapse: collapse;
    /* text-align: center; */
  }
    .btn-up{
      padding: 5px 10px;
      background-color: #008CBA;
      color: white;
      text-decoration: none;
      border-radius: 5px;
      margin: 5px;
    
     }
     .btn-up:hover{
      background-color: #005f73;
      color: white;
      text-decoration: none;
      border-radius: 5px;
     }
</style>
</head>
<body>
 <?php include('partial/menu.php'); ?>
  <!-- main content start  -->
<div class="main_content">
<div class=""><h2>Add-admin</h2>
<?php
if(isset($_SESSION['add']))//check if session message is set
{
  echo $_SESSION['add'];// Display session message if set
  unset($_SESSION['add']);// Remove session message
}
?>
 <form action="" method="POST">
<table class="tbl_admim">
<tr>
  <td>Full Name:</td>
  <td><input type="text" name="full_name" placeholder="Enter your name"></td>
</tr>
<tr>
  <td>User Name:</td>
  <td><input type="text" name="username" placeholder="Enter your user name"></td>
  </tr>
  <tr>
  <td>Password:</td>
  <td><input type="password" name="password" placeholder="Enter your password"></td>
  </tr>
  <tr>
    <td colspan="2">
      <input type="submit" name="submit" value="Add-admin" class="btn-up">
    </td>
  </tr>
</table>
 </form>
</div>
</div>
  <!-- main content end  -->

  <?php 
  //Process the value from form and save it in database
  //Check whether the submit button is clicked or not
  if(isset($_POST['submit'])){
    // echo "Button clicked";
    //1. Get the data from form
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); //  password encryption
    //2. SQL query to save the data into database
    $sql = "INSERT INTO tbl_admim SET
     full_name = '$full_name',
      username = '$username',
        password = '$password'
    ";
   //3. Execute the query and save on database
       $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
//4.check wheather the query is execute data is inserted or not 
if($result==TRUE){
  // echo "DATA IS INSERTED";
  //Create a session  variable to display message
  $_SESSION['add'] = "<div class='success'>Admin added successfully</div>";
   //Redirect page to manage admin
  header('location:' .SITEURL. 'Admin/manage-admin.php');
 
}
else{
  // echo "Data is not inserted";
  $_SESSION['add'] = 'failed to add admin';
  //Redirect page to add admin;
  header('location:'.SITEURL. 'add-admin.php');
  
}
  }
  
  ?>

   <!-- footer is start  -->
<?php include('partial/footer.php'); ?>
  <!-- footer is end  -->
</body>
</html>