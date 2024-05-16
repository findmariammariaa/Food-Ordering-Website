<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>

        <?php 
            // Check if success or error messages are set in session and display them
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']); // Clear the session variable after displaying the message
            }

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']); // Clear the session variable after displaying the message
            }
        ?>

        <!-- Add Category Form Starts -->
        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <!-- Input field to enter category title -->
                        <input type="text" name="title" placeholder="Category Title">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <!-- Input field to select category image -->
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <!-- Radio buttons to select whether the category is featured or not -->
                        <input type="radio" name="featured" value="Yes"> Yes 
                        <input type="radio" name="featured" value="No"> No 
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <!-- Radio buttons to select whether the category is active or not -->
                        <input type="radio" name="active" value="Yes"> Yes 
                        <input type="radio" name="active" value="No"> No 
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <!-- Submit button to add category -->
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>
        <!-- Add Category Form Ends -->

        <?php 
            // Handle form submission
            if(isset($_POST['submit']))
            {
                // Retrieve form data
                $title = $_POST['title'];

                // Check if 'featured' radio button is selected
                if(isset($_POST['featured']))
                {
                    $featured = $_POST['featured'];
                }
                else
                {
                    // If not selected, set default value
                    $featured = "No";
                }

                // Check if 'active' radio button is selected
                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    // If not selected, set default value
                    $active = "No";
                }

                // Check if image is selected
                if(isset($_FILES['image']['name']))
                {
                    // Upload the Image
                    $image_name = $_FILES['image']['name'];

                    // Upload the Image only if image is selected
                    if($image_name != "")
                    {
                        // Auto Rename the Image
                        $ext = end(explode('.', $image_name));
                        $image_name = "Food_Category_".rand(000, 999).'.'.$ext;

                        $source_path = $_FILES['image']['tmp_name'];
                        $destination_path = "../images/category/".$image_name;

                        // Move the uploaded image to the destination folder
                        $upload = move_uploaded_file($source_path, $destination_path);

                        // Check whether the image is uploaded successfully
                        if($upload==false)
                        {
                            // Set error message and redirect
                            $_SESSION['upload'] = "<div class='error'>Failed to upload Image. </div>";
                            header('location:'.SITEURL.'admin/add-category.php');
                            die(); // Stop further execution
                        }
                    }
                }
                else
                {
                    // Don't Upload Image and set the image_name value as blank
                    $image_name="";
                }

                // Create SQL Query to Insert Category into Database
                $sql = "INSERT INTO tbl_category SET 
                    title='$title',
                    image_name='$image_name',
                    featured='$featured',
                    active='$active'
                ";

                // Execute the Query and Save in Database
                $res = mysqli_query($conn, $sql);

                // Check whether the query executed successfully and data added or not
                if($res==true)
                {
                    // Set success message and redirect
                    $_SESSION['add'] = "<div class='success'>Category added successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                else
                {
                    // Set error message and redirect
                    $_SESSION['add'] = "<div class='error'>Failed to add category.</div>";
                    header('location:'.SITEURL.'admin/add-category.php');
                }
            }
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>
