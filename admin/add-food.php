<?php
// Include the menu partial
include('partials/menu.php'); 
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>

        <br>

        <?php 
            // Display upload message if available
            if(isset($_SESSION['upload'])) {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

            // Display add message if available
            if(isset($_SESSION['add'])) {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
        ?>
        <br/><br/>

        <!-- Form to add food -->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td><input type="text" name="title" placeholder="Title of the Food"></td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td><textarea name="description" cols="30" rows="5" placeholder="Description of the Food."></textarea></td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td><input type="number" name="price"></td>
                </tr>
                <tr>
                    <td>Select Image: </td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">
                            <?php 
                                // Fetch active categories from the database
                                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                                $res = mysqli_query($conn, $sql);
                                $count = mysqli_num_rows($res);

                                // Check if there are any categories
                                if($count > 0) {
                                    // Loop through each category
                                    while($row = mysqli_fetch_assoc($res)) {
                                        $id = $row['id'];
                                        $title = $row['title'];
                                        echo "<option value='$id'>$title</option>";
                                    }
                                } else {
                                    echo "<option value='0'>No Category Found</option>";
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes 
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes 
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php 
            // Check if the form was submitted
            if(isset($_POST['submit'])) {
                // Get data from form
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];

                // Set default values for featured and active
                $featured = isset($_POST['featured']) ? $_POST['featured'] : "No";
                $active = isset($_POST['active']) ? $_POST['active'] : "No";

                // Validate form data
                if(empty($title) || empty($description) || empty($price) || empty($category)) {
                    // If any field is empty, set error message and redirect
                    $_SESSION['add'] = "<span style='color: red;font-weight:bold'>Please fill in all fields.</span>";
                    header("location:".SITEURL.'admin/add-food.php');
                    exit();
                }

                // Check if an image is selected
                if(isset($_FILES['image']['name'])) {
                    $image_name = $_FILES['image']['name'];
                    if($image_name != "") {
                        // Rename and upload the image
                        $ext = end(explode('.', $image_name));
                        $image_name = "Food-Name-" . rand(0000, 9999) . "." . $ext;
                        $src = $_FILES['image']['tmp_name'];
                        $dst = "../images/food/" . $image_name;
                        $upload = move_uploaded_file($src, $dst);
                        if($upload == false) {
                            // If upload fails, set error message and redirect
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
                            header('location:'.SITEURL.'admin/add-food.php');
                            die();
                        }
                    }
                } else {
                    $image_name = "";
                }

                // SQL query to insert food data into the database
                $sql2 = "INSERT INTO tbl_food (title, description, price, image_name, category_id, featured, active) 
                         VALUES ('$title', '$description', $price, '$image_name', $category, '$featured', '$active')";

                // Execute the query
                $res2 = mysqli_query($conn, $sql2);

                // Check if the query execution was successful
                if($res2 == true) {
                    $_SESSION['add'] = "<div class='success'>Food Added Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                } else {
                    $_SESSION['add'] = "<div class='error'>Failed to Add Food.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
            }
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>
