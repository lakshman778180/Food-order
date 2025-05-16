<?php
// Include constants.php file
include('../config/constants.php');


//1 get the ID of admin to be deleted
 echo $id = $_GET['id'];


//2 create sql query to delete admin
$sql = "DELETE FROM tbl_admim WHERE id=$id";

//execute the query
$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

//check whether the query executed successfully or not
if($result==TRUE){
    //echo "Admin deleted successfully";
    //create session variable to display message
  // echo "Delete admin successfully";
  $_SESSION['delete'] = "<div class='success'>Admin deleted successfully</div>";
    //redirect to manage admin page
    header('location:'.SITEURL.'Admin/manage-admin.php');
}
else{
    //echo "Failed to delete admin";
  //  echo "failde to delete admin";
  $_SESSION['delete'] = '<div class="error">Failed to delete admin</div>';
    //redirect to manage admin page
    header('location:'.SITEURL.'Admin/manage-admin.php');
}


//3 redirect to manage admin with session message(success/error)


?>

