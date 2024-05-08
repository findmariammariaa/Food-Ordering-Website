<?php

    //include constants.php file here
    include('../config/constants.php');


    //get the id of admin to be deleted
     $id = $_GET['id'];


    //create sql query to delete admin

    $sql = "Delete FROM tbl_admin WHERE id=$id";



    //execute query
    $res= mysqli_query($conn,$sql);

    //check whether admin added successfully or not
    if($res==true){
        //echo "Admin deleted";
        //create session varriable to display msg
        $_SESSION['delete']="<span style='color: green;'>Admin deleted successfully.</span>";
        //redirect to manage admin page
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else{
        //echo "failed to delete";
        $_SESSION['delete']="<span style='color: red;'>Failed to delete admin. Try again later.</span>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    //redirect to manage admin page with msg(success/failed)
?>