<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/admin.css">
  <title>Manage Categories</title>
<style>
   table {
      width: 100%;
      border-collapse: collapse;
    }
    th, td {
      padding: 10px;
      text-align: left;
      border-bottom: 1px solid black;
    }
    th {
      background-color: #f2f2f2;
    }
    .btn {
      padding: 5px 10px;
      background-color: #4CAF50;
      color: white;
      text-decoration: none;
      border-radius: 5px;
      margin: 5px;
    }
    .btn-danger {
      background-color: #f44336;
    }
    .btn:hover {
      background-color: #45a049;
    }
    .btn-danger:hover {
      background-color: #d32f2f;
    }
    .btn-up {
      padding: 5px 10px;
      background-color: #008CBA;
      color: white;
      text-decoration: none;
      border-radius: 5px;
      margin-bottom: 10px;
      display: inline-block;
    }
    .btn-up:hover {
      background-color: #005f73;
    }
    .success {
      color: #4CAF50;
      background-color: #e8f5e9;
      padding: 10px;
      border-radius: 5px;
      margin-bottom: 15px;
    }
    .error {
      color: #f44336;
      background-color: #ffebee;
      padding: 10px;
      border-radius: 5px;
      margin-bottom: 15px;
    }
    .category-img {
      width: 100px;
      height: auto;
    }
    .text-center {
      text-align: center;
    }
    .featured-active {
      font-weight: bold;
      color: #4CAF50;
    }
    .featured-inactive {
      color: #f44336;
    }
</style>
</head>
<body>
  <?php include('partial/menu.php'); ?>
  <!-- main content start -->
  <div class="main_content">
    <div class="Manage_text">
      <h2>Manage Categories</h2>
      
      <!-- Button to Add Category -->
      <a href="<?php echo SITEURL; ?>Admin/add-category.php" class="btn-up">Add Category</a><br><br>
      
      <!-- Display Session Messages if any -->
      <?php
        if(isset($_SESSION['add'])) {
          echo $_SESSION['add'];
          unset($_SESSION['add']);
        }
        
        if(isset($_SESSION['delete'])) {
          echo $_SESSION['delete'];
          unset($_SESSION['delete']);
        }
        
        if(isset($_SESSION['update'])) {
          echo $_SESSION['update'];
          unset($_SESSION['update']);
        }
        
        if(isset($_SESSION['no-category-found'])) {
          echo $_SESSION['no-category-found'];
          unset($_SESSION['no-category-found']);
        }
        
        if(isset($_SESSION['upload'])) {
          echo $_SESSION['upload'];
          unset($_SESSION['upload']);
        }
        
        if(isset($_SESSION['failed-remove'])) {
          echo $_SESSION['failed-remove'];
          unset($_SESSION['failed-remove']);
        }
      ?>
      
      <!-- Categories Table -->
      <table class="tbl_full">
        <tr>
          <th>S.N.</th>
          <th>Title</th>
          <th>Image</th>
          <th>Featured</th>
          <th>Active</th>
          <th>Actions</th>
        </tr>
        
        <?php
          // Query to get all categories from the database
          $sql = "SELECT * FROM tbl_category";
          
          // Execute the query
          $result = mysqli_query($conn, $sql);
          
          // Count rows to check whether we have categories or not
          $count = mysqli_num_rows($result);
          
          // Create serial number variable
          $sn = 1;
          
          // Check whether we have data in database or not
          if($count > 0) {
            // We have data in database
            // Get the data and display
            while($row = mysqli_fetch_assoc($result)) {
              $id = $row['id'];
              $title = $row['tittle']; // Note: your DB column is named 'tittle' not 'title'
              $image_name = $row['image_name'];
              $featured = $row['featured'];
              $active = $row['active'];
              ?>
              
              <tr>
                <td><?php echo $sn++; ?></td>
                <td><?php echo $title; ?></td>
                <td>
                  <?php 
                    // Check whether image name is available or not
                    if($image_name != "") {
                      // Display the image
                      ?>
                      <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" class="category-img">
                      <?php
                    } else {
                      // Display the message
                      echo "<div class='error'>Image not added.</div>";
                    }
                  ?>
                </td>
                <td><?php echo ($featured == "yes") ? "<span class='featured-active'>Yes</span>" : "<span class='featured-inactive'>No</span>"; ?></td>
                <td><?php echo ($active == "yes") ? "<span class='featured-active'>Yes</span>" : "<span class='featured-inactive'>No</span>"; ?></td>
                <td>
                  <a href="<?php echo SITEURL; ?>Admin/update-category.php?id=<?php echo $id; ?>" class="btn">Update</a>
                  <a href="<?php echo SITEURL; ?>Admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this category?');">Delete</a>
                </td>
              </tr>
              
              <?php
            }
          } else {
            // No data in database
            // We'll display the message inside the table
            ?>
            
            <tr>
              <td colspan="6" class="text-center">No Categories Added Yet.</td>
            </tr>
            
            <?php
          }
        ?>
      </table>
    </div>
  </div>
  <!-- main content end -->
  
  <!-- footer start -->
  <?php include('partial/footer.php'); ?>
  <!-- footer end -->
</body>
</html>















