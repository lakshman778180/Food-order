
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin.css">
    <title>Update Category</title>
    <style>
        table {
            width: 50%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        .btn-up {
            padding: 5px 10px;
            background-color: #008CBA;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 5px;
            border: none;
            cursor: pointer;
        }
        .btn-up:hover {
            background-color: #005f73;
        }
        .current-image {
            max-width: 150px;
            margin: 10px 0;
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
    </style>
</head>
<body>
    <?php include('partial/menu.php'); ?>

    <div class="main_content">
        <div class="">
            <h2>Update Category</h2>
            <br><br>

            <?php
                // Check if id is set
                if(isset($_GET['id'])) {
                    // Get the ID and all other details
                    $id = $_GET['id'];
                    
                    // SQL Query to get all other details
                    $sql = "SELECT * FROM tbl_category WHERE id = $id";
                    
                    // Execute the Query
                    $result = mysqli_query($conn, $sql);
                    
                    // Count the rows to check whether the id is valid or not
                    $count = mysqli_num_rows($result);
                    
                    if($count == 1) {
                        // Get all the data
                        $row = mysqli_fetch_assoc($result);
                        $title = $row['tittle']; // Note the column name 'tittle' not 'title'
                        $current_image = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];
                    } else {
                        // Redirect to manage category with error message
                        $_SESSION['no-category-found'] = "<div class='error'>Category not found.</div>";
                        header('location:'.SITEURL.'Admin/manage-category.php');
                        exit();
                    }
                } else {
                    // Redirect to manage category
                    header('location:'.SITEURL.'Admin/manage-category.php');
                    exit();
                }
            ?>

            <form action="" method="POST" enctype="multipart/form-data">
                <table>
                    <tr>
                        <td>Title:</td>
                        <td>
                            <input type="text" name="title" value="<?php echo $title; ?>" required>
                        </td>
                    </tr>
                    <tr>
                        <td>Current Image:</td>
                        <td>
                            <?php
                                if($current_image != "") {
                                    // Display the image
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" class="current-image">
                                    <?php
                                } else {
                                    // Display message
                                    echo "<div class='error'>Image not added.</div>";
                                }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>New Image:</td>
                        <td>
                            <input type="file" name="image">
                            <p><small>(Leave empty if you don't want to change the image)</small></p>
                        </td>
                    </tr>
                    <tr>
                        <td>Featured:</td>
                        <td>
                            <input <?php if($featured == "yes") {echo "checked";} ?> type="radio" name="featured" value="yes"> Yes
                            <input <?php if($featured == "no") {echo "checked";} ?> type="radio" name="featured" value="no"> No
                        </td>
                    </tr>
                    <tr>
                        <td>Active:</td>
                        <td>
                            <input <?php if($active == "yes") {echo "checked";} ?> type="radio" name="active" value="yes"> Yes
                            <input <?php if($active == "no") {echo "checked";} ?> type="radio" name="active" value="no"> No
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" name="submit" value="Update Category" class="btn-up">
                        </td>
                    </tr>
                </table>
            </form>

            <?php
                if(isset($_POST['submit'])) {
                    // 1. Get all the values from the form
                    $id = mysqli_real_escape_string($conn, $_POST['id']);
                    $title = mysqli_real_escape_string($conn, $_POST['title']);
                    $current_image = $_POST['current_image'];
                    $featured = isset($_POST['featured']) ? $_POST['featured'] : 'no';
                    $active = isset($_POST['active']) ? $_POST['active'] : 'no';
                    
                    // 2. Updating New Image if selected
                    // Check whether the image is selected or not
                    if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {
                        // Get the image details
                        $image_name = $_FILES['image']['name'];
                        
                        // Check if file is an image
                        $allowed_extensions = array('jpg', 'jpeg', 'png', 'gif');
                        $file_extension = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
                        
                        if(!in_array($file_extension, $allowed_extensions)) {
                            $_SESSION['upload'] = "<div class='error'>Only JPG, JPEG, PNG, or GIF files are allowed.</div>";
                            header('location:'.SITEURL.'Admin/update-category.php?id='.$id);
                            exit();
                        }
                        
                        // Rename the image to avoid duplicates
                        $image_name = "Category_".rand(000, 999).'.'.$file_extension;
                        
                        $source_path = $_FILES['image']['tmp_name'];
                        $destination_path = "../images/category/".$image_name;
                        
                        // Upload the image
                        $upload = move_uploaded_file($source_path, $destination_path);
                        
                        // Check whether the image is uploaded or not
                        if($upload == false) {
                            // Set message
                            $_SESSION['upload'] = "<div class='error'>Failed to upload image.</div>";
                            // Redirect to update category page
                            header('location:'.SITEURL.'Admin/update-category.php?id='.$id);
                            exit();
                        }
                        
                        // Remove the current image if available
                        if($current_image != "" && file_exists("../images/category/".$current_image)) {
                            unlink("../images/category/".$current_image);
                        }
                    } else {
                        // Don't upload image and use the current image name
                        $image_name = $current_image;
                    }
                    
                    // 3. Update the database
                    $sql2 = "UPDATE tbl_category SET 
                        tittle = '$title',
                        image_name = '$image_name',
                        featured = '$featured',
                        active = '$active' 
                        WHERE id = $id
                    ";
                    
                    // Execute the Query
                    $result2 = mysqli_query($conn, $sql2);
                    
                    // 4. Redirect to Manage Category with message
                    if($result2 == true) {
                        // Category updated
                        $_SESSION['update'] = "<div class='success'>Category updated successfully.</div>";
                        header('location:'.SITEURL.'Admin/manage-category.php');
                    } else {
                        // Failed to update category
                        $_SESSION['update'] = "<div class='error'>Failed to update category.</div>";
                        header('location:'.SITEURL.'Admin/manage-category.php');
                    }
                }
            ?>
        </div>
    </div>

    <?php include('partial/footer.php'); ?>
</body>
</html>