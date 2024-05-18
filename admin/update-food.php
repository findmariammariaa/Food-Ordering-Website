<?php 
include('partials/menu.php');

// Check whether the 'id' is set in the URL parameter
if (isset($_GET['id'])) {
    // Get the 'id' value from the URL
    $id = $_GET['id'];

    // SQL Query to get the selected food details
    $sql2 = "SELECT * FROM tbl_food WHERE id=$id";
    // Execute the query
    $res2 = mysqli_query($conn, $sql2);

    // Get the value based on the query executed
    $row2 = mysqli_fetch_assoc($res2);

    // Check if the result is available
    if ($row2) {
        // Get the individual values of the selected food
        $title = $row2['title'];
        $description = $row2['description'];
        $price = $row2['price'];
        $current_image = $row2['image_name'];
        $current_category = $row2['category_id'];
        $featured = $row2['featured'];
        $active = $row2['active'];
    } else {
        // Redirect to Manage Food page if no data found
        header('location:' . SITEURL . 'admin/manage-food.php');
        exit();
    }
} else {
    // Redirect to Manage Food page if 'id' is not set
    header('location:' . SITEURL . 'admin/manage-food.php');
    exit();
}

// Processing form submission
if (isset($_POST['submit'])) {
    // Get all the details from the form
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $current_image = $_POST['current_image'];
    $category = $_POST['category'];
    $featured = $_POST['featured'];
    $active = $_POST['active'];

    // Check whether a new image is selected or not
    if (isset($_FILES['image']['name'])) {
        // New image selected
        $image_name = $_FILES['image']['name'];

        if ($image_name != "") {
            // Rename the image
            $ext = end(explode('.', $image_name));
            $image_name = "Food-Name-" . rand(0000, 9999) . '.' . $ext;

            // Get the source and destination paths
            $src_path = $_FILES['image']['tmp_name'];
            $dest_path = "../images/food/" . $image_name;

            // Upload the new image
            $upload = move_uploaded_file($src_path, $dest_path);

            if ($upload == false) {
                // Failed to upload new image
                $_SESSION['upload'] = "<div class='error'>Failed to Upload new Image.</div>";
                header('location:' . SITEURL . 'admin/manage-food.php');
                exit();
            }

            // Remove the current image if available
            if ($current_image != "") {
                $remove_path = "../images/food/" . $current_image;
                $remove = unlink($remove_path);

                if ($remove == false) {
                    // Failed to remove current image
                    $_SESSION['remove-failed'] = "<div class='error'>Failed to remove current image.</div>";
                    header('location:' . SITEURL . 'admin/manage-food.php');
                    exit();
                }
            }
        } else {
            // No new image selected, retain the current image
            $image_name = $current_image;
        }
    } else {
        // No new image selected, retain the current image
        $image_name = $current_image;
    }

    // SQL Query to update the food in the database
    $sql3 = "UPDATE tbl_food SET 
        title = '$title', 
        description = '$description', 
        price = $price, 
        image_name = '$image_name', 
        category_id = '$category', 
        featured = '$featured', 
        active = '$active' 
        WHERE id=$id";
    
    // Execute the SQL Query
    $res3 = mysqli_query($conn, $sql3);

    if ($res3 == true) {
        // Query executed successfully, food updated
        $_SESSION['update'] = "<div class='success'>Food Updated Successfully.</div>";
        header('location:' . SITEURL . 'admin/manage-food.php');
        exit();
    } else {
        // Failed to update food
        $_SESSION['update'] = "<div class='error'>Failed to Update Food.</div>";
        header('location:' . SITEURL . 'admin/manage-food.php');
        exit();
    }
}
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td><input type="text" name="title" value="<?php echo $title; ?>"></td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td><textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea></td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td><input type="number" name="price" value="<?php echo $price; ?>"></td>
                </tr>

                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php 
                            if ($current_image == "") {
                                echo "<div class='error'>Image not Available.</div>";
                            } else {
                                echo "<img src='" . SITEURL . "images/food/" . $current_image . "' width='150px'>";
                            }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>Select New Image: </td>
                    <td><input type="file" name="image"></td>
                </tr>

                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">
                            <?php 
                                // SQL Query to get all active categories
                                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                                $res = mysqli_query($conn, $sql);
                                $count = mysqli_num_rows($res);

                                if ($count > 0) {
                                    // Display categories as options
                                    while ($row = mysqli_fetch_assoc($res)) {
                                        $category_title = $row['title'];
                                        $category_id = $row['id'];
                                        ?>
                                        <option <?php if ($current_category == $category_id) { echo "selected"; } ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                        <?php
                                    }
                                } else {
                                    // Display message if no category is available
                                    echo "<option value='0'>Category Not Available.</option>";
                                }
                            ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if ($featured == "Yes") { echo "checked"; } ?> type="radio" name="featured" value="Yes"> Yes 
                        <input <?php if ($featured == "No") { echo "checked"; } ?> type="radio" name="featured" value="No"> No 
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if ($active == "Yes") { echo "checked"; } ?> type="radio" name="active" value="Yes"> Yes 
                        <input <?php if ($active == "No") { echo "checked"; } ?> type="radio" name="active" value="No"> No 
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php'); ?>
