<?php
    // Include constants file
    include('../config/constants.php');
    
    // Check whether the id parameter is set
    if(isset($_GET['id'])) {
        // Get the category ID from URL parameter
        $id = mysqli_real_escape_string($conn, $_GET['id']);
        
        // First, retrieve all category information before deleting
        $query = "SELECT * FROM tbl_category WHERE id = $id";
        $result = mysqli_query($conn, $query);
        
        if($result && mysqli_num_rows($result) > 0) {
            $category = mysqli_fetch_assoc($result);
            $title = $category['tittle']; // Note the column name 'tittle'
            $image_name = $category['image_name'];
            $featured = $category['featured'];
            $active = $category['active'];
            
            // Remove the physical image file if available
            if($image_name != "") {
                // Image is available, so remove it
                $path = "../images/category/".$image_name;
                
                if(file_exists($path)) {
                    // Remove the image
                    $remove = unlink($path);
                    
                    // If failed to remove image, add an error message but continue the process
                    if($remove == false) {
                        $_SESSION['failed-remove'] = "<div class='error'>Failed to remove category image for '$title'.</div>";
                    }
                }
            }
            
            // Delete data from database using prepared statement
            $stmt = mysqli_prepare($conn, "DELETE FROM tbl_category WHERE id = ?");
            mysqli_stmt_bind_param($stmt, "i", $id);
            mysqli_stmt_execute($stmt);
            
            // Check whether the data is deleted from database or not
            if(mysqli_stmt_affected_rows($stmt) > 0) {
                // Set success message and redirect
                $_SESSION['delete'] = "<div class='success'>Category '$title' deleted successfully.</div>";
            } else {
                // Set fail message and redirect
                $_SESSION['delete'] = "<div class='error'>Failed to delete category '$title'.</div>";
            }
            
            mysqli_stmt_close($stmt);
        } else {
            // Category not found
            $_SESSION['delete'] = "<div class='error'>Category not found.</div>";
        }
    } else {
        // Redirect to Manage Category Page if id is not set
        $_SESSION['delete'] = "<div class='error'>Unauthorized access: Category ID not provided.</div>";
    }
    
    // Redirect to manage category page
    header('location:'.SITEURL.'Admin/manage-category.php');
    exit();
?>
