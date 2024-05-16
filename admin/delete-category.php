<?php 
    // Include Constants File
    include('../config/constants.php');

    // Check if 'id' and 'image_name' values are set in the URL
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        // Get the ID and image_name from the URL
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        // Remove the physical image file if available
        if($image_name != "")
        {
            // Define the path to the image
            $path = "../images/category/".$image_name;
            
            // Remove the image file from the server
            $remove = unlink($path);

            // Check if the image removal was successful
            if($remove==false)
            {
                // If failed to remove image, set error message and redirect
                $_SESSION['remove'] = "<div class='error'>Failed to remove category image.</div>";
                header('location:'.SITEURL.'admin/manage-category.php');
                die(); // Stop further execution
            }
        }

        // Delete data from the database
        // SQL Query to delete data from the database based on the given ID
        $sql = "DELETE FROM tbl_category WHERE id=$id";

        // Execute the SQL query
        $res = mysqli_query($conn, $sql);

        // Check if data is successfully deleted from the database
        if($res==true)
        {
            // If data is deleted successfully, set success message and redirect
            $_SESSION['delete'] = "<div class='success'>Category deleted successfully.</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else
        {
            // If failed to delete data, set error message and redirect
            $_SESSION['delete'] = "<div class='error'>Failed to delete category.</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }
    }
    else
    {
        // If 'id' or 'image_name' is not set in the URL, redirect to Manage Category Page
        header('location:'.SITEURL.'admin/manage-category.php');
    }
?>
