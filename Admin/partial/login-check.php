 <?php
 //Authorization - access Control
 //Check whether the user is logged or not 
 if(!isset($_SESSION["user"])) // if user session is not set 
 {
//user  is not logged in
 // redirect to login with message 
 $_SESSION["no-login-message"] = "<div class='error'>Please login to access Admin panel</div>";
 //redirect to login page 
 header("location:" .SITEURL."Admin/login.php");
 }
 ?>