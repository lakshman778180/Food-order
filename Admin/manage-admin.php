<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Manage the Admin Panel</title>
  <link rel="stylesheet" href="../css/admin.css" />
 <style>
  * {
    box-sizing: border-box;
  }

  body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(to right, #e0eafc, #cfdef3);
    margin: 0;
    padding: 0;
  }

  .main_content {
    padding: 30px;
    max-width: 1100px;
    margin: auto;
    animation: fadeIn 1s ease-in;
  }

  h1 {
    text-align: center;
    color: #333;
    margin-bottom: 20px;
  }

  .btn,
  .btn-up {
    padding: 8px 16px;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    transition: all 0.3s ease;
    display: inline-block;
    margin-bottom: 10px;
    font-weight: 500;
  }

  .btn {
    background-color: #28a745;
  }

  .btn:hover {
    background-color: #218838;
    transform: translateY(-2px);
  }

  .btn-up {
    background-color: #007bff;
  }

  .btn-up:hover {
    background-color: #0056b3;
    transform: scale(1.05);
  }

  table {
    width: 100%;
    border-collapse: collapse;
    background: #fff;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    overflow: hidden;
    animation: fadeUp 0.8s ease-in-out;
  }

  th,
  td {
    padding: 12px 15px;
    text-align: left;
  }

  th {
    background-color: #f5f5f5;
    color: #444;
    text-transform: uppercase;
    font-size: 14px;
  }

  tr:nth-child(even) {
    background-color: #f9f9f9;
  }

  tr:hover {
    background-color: #eef3f8;
    transition: background-color 0.3s;
  }

  .success {
    color: green;
    font-size: 18px;
    text-align: center;
    margin-top: 20px;
  }

  .error {
    color: red;
    font-size: 18px;
    text-align: center;
    margin-top: 20px;
  }

  @keyframes fadeIn {
    from {
      opacity: 0;
    }
    to {
      opacity: 1;
    }
  }

  @keyframes fadeUp {
    from {
      opacity: 0;
      transform: translateY(20px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  /* Enhanced Responsive */
  @media screen and (max-width: 768px) {
    .main_content {
      padding: 15px;
    }

    table,
    thead,
    tbody,
    th,
    td,
    tr {
      display: block;
      width: 100%;
    }

    thead {
      display: none;
    }

    tr {
      margin-bottom: 15px;
      border: 1px solid #ddd;
      border-radius: 8px;
      background-color: #fff;
      padding: 10px;
      box-shadow: 0 1px 5px rgba(0, 0, 0, 0.05);
    }

    td {
      position: relative;
      padding-left: 50%;
      text-align: right;
      border: none;
      border-bottom: 1px solid #eee;
    }

    td:last-child {
      border-bottom: none;
    }

    td::before {
      position: absolute;
      top: 12px;
      left: 15px;
      width: 45%;
      white-space: nowrap;
      font-weight: bold;
      color: #333;
      text-align: left;
    }

    td:nth-of-type(1)::before { content: "Sr No"; }
    td:nth-of-type(2)::before { content: "Full Name"; }
    td:nth-of-type(3)::before { content: "Username"; }
    td:nth-of-type(4)::before { content: "Actions"; }
  }
</style>


</head>

<body>

  <!-- Navbar (Optional) -->
  <?php include('partial/menu.php'); ?>

  <div class="main_content">
    <div class="Manage_text">
      <h1>Manage the Admin</h1>
      <a href="add-admin.php" class="btn-up">Add Admin</a><br><br>
      <?php

      if (isset($_SESSION['add'])) {
        echo $_SESSION['add'];// Display session message
        unset($_SESSION['add']);// Remove session message
      }
      if (isset($_SESSION['delete'])) {
        echo $_SESSION['delete'];// Display session message
        unset($_SESSION['delete']);// Remove session message
      }
      if (isset($_SESSION['update'])) {
        echo $_SESSION['update'];// Display session message
        unset($_SESSION['update']);// Remove session message
      }
      ?>
      <br><br>

      <table class="tbl_full">
        <tr>
          <th>Sr No</th>
          <th>Full Name</th>
          <th>User Name</th>
          <th>Actions</th>
        </tr>
        <?php
        //query to get all admin
        $sql = "SELECT * FROM tbl_admim";
        //execute the query
        $result = mysqli_query($conn, $sql);
        if ($result == TRUE) {
          //count rows to check whether we have data in database
          $count = mysqli_num_rows($result);
          $sn = 1; //create a variable and assign value
          if ($count > 0) {
            //we have data in database
            while ($rows = mysqli_fetch_assoc($result)) {
              //using while loop to get all the data from database
              //and while loop will run as long as we have data in database
              $id = $rows['id'];
              $full_name = $rows['full_name'];
              $username = $rows['username'];
              ?>
              <tr>
                <td><?php echo $sn++; ?></td>
                <td><?php echo $full_name; ?></td>
                <td><?php echo $username; ?></td>
                <td>
                  <a href="<?php echo SITEURL; ?>Admin/update-admin.php?id=<?php echo $id; ?>" class="btn">Update Admin</a>
                  <a href="<?php echo SITEURL; ?>Admin/delete-admin.php?id=<?php echo $id; ?>" class="btn">Delete Admin</a>
                </td>
              </tr>
              <?php
            }
          } else {
            //we do not have data in database
            ?>
            <tr>
              <td colspan="4">
                <div class="error">No Admin Added Yet.</div>
              </td>
            </tr>
            <?php
          }
        }
        ?>
      </table>
    </div>
  </div>
  <!-- Footer -->
  <?php include('partial/footer.php'); ?>

</body>

</html>