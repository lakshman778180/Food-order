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
<div class=""><h2>Add-category</h2>
<br><br>
<?php
if(isset($_SESSION['add']))//check if session message is set
{
  echo $_SESSION['add'];// Display session message if set
  unset($_SESSION['add']);// Remove session message
}
if(isset($_SESSION['upload']))//check if session message is set
{
  echo $_SESSION['upload'];// Display session message if set
  unset($_SESSION['upload']);// Remove session message
}
?>
<form action="" method="POST" enctype="multipart/form-data">
<table class="tbl_admim">
  <tr>
    <td>Tittle:</td>
    <td>
      <input type="text" name="tittle" placeholder="Category title">
    </td>
  </tr>
  <tr>
    <td>Select Image:</td>
    <td>
      <input type="file" name="image">
    </td>
  <tr>
    <td>Feature:</td>
    <td>
      <input type="radio" name="featured" value="yes">Yes
      <input type="radio" name="featured" value="no">No
    </td>
  </tr>
   <tr>
    <td>Active:</td>
    <td>
      <input type="radio" name="active" value="yes">Yes
      <input type="radio" name="active" value="no">No
    </td>
  </tr>
<tr>
  <td colspan="2">
    <input type="submit" name="submit" value="Add Category" class="btn-up">
  </td>
  </tr>
  </table>
 </form>
</div>
</div>

<?php
//check whether the submit button is clicked or not
if(isset($_POST['submit'])) {
  //1. get the value from the form category form
  $tittle = $_POST['tittle'];
  
  // for radio input we need to check whether the button is selected or not
  if(isset($_POST['featured'])) {
    //get the value from the form
    $featured = $_POST['featured'];
  } else {
    //set the default value
    $featured = "no";
  }
  
  if(isset($_POST["active"])) {
    //get the value from the form
    $active = $_POST['active'];
  } else {
    //set the default value
    $active = "no";
  }
  
  //image upload
  //check whether the image is selected or not
  //print_r($_FILES['image']);
  //die();
  
  $image_name = ""; // Default empty value
  
  if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {
    //upload the image
    //to upload image we need image name, source path and destination path
    $image_name = $_FILES['image']['name'];
    $source_path = $_FILES['image']['tmp_name'];
    $destination_path = "../images/category/".$image_name;

    //finally upload the image
    $upload = move_uploaded_file($source_path, $destination_path);
    
    //check whether the image is uploaded or not
    if($upload == FALSE) {
      //set message
      $_SESSION['upload'] = "<div class='error'>Failed to upload image</div>";
      //redirect to add category page
      header('location:'.SITEURL.'Admin/add-category.php');
      die();
    }
  }

  //2 create sql query to insert category
  $sql = "INSERT INTO tbl_category SET
    tittle = '$tittle',
    image_name = '$image_name',
    featured = '$featured',
    active = '$active'
    ";
  
  //3. execute the query and save in database
  $result = mysqli_query($conn, $sql);

  //4. check whether the query is executed or not
  if($result == TRUE) {
    //query executed successfully
    //create a session variable to display message
    $_SESSION['add'] = "<div class='success'>Category added successfully</div>";
    //redirect to manage category page
    header('location:'.SITEURL.'Admin/manage-category.php');
  } else {
    //failed to add category
    $_SESSION['add'] = "<div class='error'>Failed to add category</div>";
    //redirect to add category page
    header('location:'.SITEURL.'Admin/add-category.php');
  }
}
?>

<?php include('partial/footer.php'); ?>
  <!-- footer is end  -->
</body>
</html>
