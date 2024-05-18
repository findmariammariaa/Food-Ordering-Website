<?php 
// Include the constants configuration file
include('../config/constants.php');

// Check if the ID and image name are set in the GET request
if(isset($_GET['id']) && isset($_GET['image_name'])) 
{
    // Get the ID and image name from the GET request
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    // Check if an image name is provided and remove the image if it exists
    if($image_name != "")
    {
        // Set the path to the image
        $path = "../images/food/".$image_name;

        // Attempt to remove the image file
        $remove = unlink($path);

        // Check if the image removal was unsuccessful
        if($remove == false)
        {
            // Set an error message in the session and redirect to the manage food page
            $_SESSION['upload'] = "<div class='error'>Failed to Remove Image File.</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
            // Stop further script execution
            die();
        }
    }

    // Create an SQL query to delete the food item from the database
    $sql = "DELETE FROM tbl_food WHERE id=$id";
    // Execute the query
    $res = mysqli_query($conn, $sql);

    // Check if the query was executed successfully
    if($res == true)
    {
        // Set a success message in the session and redirect to the manage food page
        $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully.</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }
    else
    {
        // Set an error message in the session and redirect to the manage food page
        $_SESSION['delete'] = "<div class='error'>Failed to Delete Food.</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }
}
else
{
    // Redirect to the manage food page if the ID or image name is not set
    $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access.</div>";
    header('location:'.SITEURL.'admin/manage-food.php');
}
?>
