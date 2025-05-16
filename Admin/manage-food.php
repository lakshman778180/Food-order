 <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/admin.css">
  <title>manage-foot</title>
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
    .btn:hover {
      background-color: #45a049;
    }
     .btn-up{
      padding: 5px 10px;
      background-color: #008CBA;
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
<div class="Manage_text"> <h2>Manage the Food </h2>
<a href="add-admin.php" class="btn-up">Add food </a><br><br>
      <table class="tbl_full">
        <tr>
          <th>Sr No</th>
          <th>Full Name</th>
          <th>User Name</th>
          <th>Actions</th>
        </tr>
        <tr>
          <td>1</td>
          <td>Lakshman Jha</td>
          <td>itsLakshmanjha</td>
          <td>
            <a href="#" class="btn">Update Admin</a>
            <a href="#" class="btn">Delete Admin</a>
          </td>
        </tr>
         <tr>
          <td>2</td>
          <td> Shreya kumari</td>
          <td>itsshreyajha</td>
          <td>
            <a href="#" class="btn">Update Admin</a>
            <a href="#" class="btn">Delete Admin</a>
          </td>
        </tr>
         <tr>
          <td>3</td>
          <td>Ram  Jha</td>
          <td>itsRamjha</td>
          <td>
            <a href="#" class="btn">Update Admin</a>
            <a href="#" class="btn">Delete Admin</a>
          </td>
        </tr>
      </table>
</div>
</div>
  <!-- main content end  -->
   <!-- footer is start  -->
<?php include('partial/footer.php'); ?>
  <!-- footer is end  -->
</body>
</html>