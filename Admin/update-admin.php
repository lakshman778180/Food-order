<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/admin.css">
  <title>Update-admin</title>
  <style>
    table {
      /* width: 20%; */
      border-collapse: collapse;
      /* text-align: center; */
    }

    .btn-up {
      padding: 5px 10px;
      background-color: #008CBA;
      color: white;
      text-decoration: none;
      border-radius: 5px;
      margin: 5px;

    }

    .btn-up:hover {
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
    <div class="">
      <h2>Update-admin</h2>
      <?php
      //1 get the id of selected admin
      $id = $_GET['id'];
      //2. create sql query to get the details
      $sql = "SELECT * FROM tbl_admim WHERE id=$id";
      //3. execute the query
      $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
      //4 check whether the query is executed or not
      if ($result == TRUE) {
        //check whether the data is available or not
        $count = mysqli_num_rows($result);
        //check whether we have admin data or not
        if ($count == 1) {
          //get the details
          $row = mysqli_fetch_assoc($result);
          //get individual value
          $full_name = $row['full_name'];
          $username = $row['username'];
        } else {
          //redirect to manage admin page
          header('location:' . SITEURL . 'Admin/manage-admin.php');
        }
      }

      ?>



      <form action="" method="POST">
        <table class="tbl_admim">
          <tr>
            <td>Full Name:</td>
            <td><input type="text" name="full_name" placeholder="Enter your name" value="<?php echo $full_name; ?>"></td>
          </tr>
          <tr>
            <td>User Name:</td>
            <td><input type="text" name="username" placeholder="Enter your user name" value="<?php echo $username ?>">
            </td>
          </tr>

          <tr>
            <td colspan="2">
              <input type="submit" name="submit" value="Updated admin" class="btn-up">
            </td>
          </tr>
        </table>
      </form>
    </div>
  </div>
  <?php
  //1 submit button clicked
  if (isset($_POST['submit'])) {
    //echo "Button clicked";
    //2. get the value from form
    $id = $_GET['id'];
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    //3. create sql query to update admin
    $sql = "UPDATE tbl_admim SET
  full_name = '$full_name',
  username = '$username'
  WHERE id=$id
  ";
    //4. execute the query
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    //5. check whether the query executed successfully or not
    if ($result == TRUE) {
      //redirect to manage admin page with session message
      $_SESSION['update'] = "<div class='success'>Admin updated successfully</div>";
      header('location:' . SITEURL . 'Admin/manage-admin.php');
    } else {
      //redirect to manage admin page with session message
      $_SESSION['update'] = "<div class='error'>Failed to update admin</div>";
      header('location:' . SITEURL . 'Admin/manage-admin.php');
    }
  }

  ?>


  <!-- main content end  -->
  <!-- footer is start  -->
  <?php include('partial/footer.php'); ?>
  <!-- footer is end  -->
</body>

</html>