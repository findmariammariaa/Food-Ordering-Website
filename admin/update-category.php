<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>

        <?php 
            // Check if ID parameter is set in the URL
            if(isset($_GET['id']))
            {
                // Get the category ID from the URL
                $id = $_GET['id'];
                
                // SQL query to retrieve category details based on the ID
                $sql = "SELECT * FROM tbl_category WHERE id=$id";
                
                // Execute the query
                $res = mysqli_query($conn, $sql);
                
                // Check if any rows are returned
                $count = mysqli_num_rows($res);

                if($count==1)
                {
                    // Fetch the category details from the result
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $current_image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                }
                else
                {
                    // If no category found with the given ID, redirect with an error message
                    $_SESSION['no-category-found'] = "<div class='error'>Category not Found.</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
            }
            else
            {
                // If ID parameter is not set in the URL, redirect to manage category page
                header('location:'.SITEURL.'admin/manage-category.php');
            }
        ?>

        <!-- Form to update category details -->
        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <!-- Input field to update category title -->
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php 
                            // Display current category image if available
                            if($current_image != "")
                            {
                                ?>
                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="150px">
                                <?php
                            }
                            else
                            {
                                // Display message if no image available
                                echo "<div class='error'>Image not added.</div>";
                            }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>New Image: </td>
                    <td>
                        <!-- Input field to upload new category image -->
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <!-- Radio buttons to update whether the category is featured or not -->
                        <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes 
                        <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No"> No 
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <!-- Radio buttons to update whether the category is active or not -->
                        <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes"> Yes 
                        <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No"> No 
                    </td>
                </tr>

                <tr>
                    <td>
                        <!-- Hidden input fields to carry ID and current image value -->
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <!-- Submit button to update category -->
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php 
            // Handle form submission
            if(isset($_POST['submit']))
            {
                // Retrieve form data
                $id = $_POST['id'];
                $title = $_POST['title'];
                $current_image = $_POST['current_image'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];

                // Process image upload
                if(isset($_FILES['image']['name']))
                {
                    $image_name = $_FILES['image']['name'];

                    if($image_name != "")
                    {
                        // Upload new image if selected
                        // Code for image upload omitted for brevity
                    }
                    else
                    {
                        $image_name = $current_image;
                    }
                }
                else
                {
                    $image_name = $current_image;
                }

                // Update category details in the database
                $sql2 = "UPDATE tbl_category SET 
                    title = '$title',
                    image_name = '$image_name',
                    featured = '$featured',
                    active = '$active' 
                    WHERE id=$id
                ";

                // Execute the update query
                $res2 = mysqli_query($conn, $sql2);

                // Redirect with success or error message
                if($res2==true)
                {
                    $_SESSION['update'] = "<div class='success'>Category Updated Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                else
                {
                    $_SESSION['update'] = "<div class='error'>Failed to Update Category.</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
            }
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>
