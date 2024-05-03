<?php include('partials/menu.php');?>
<div class="main-content">
    <div class="wrapper"></div>
    <h1>Add Admin</h1>
<br/><br/>

    <form action=""method="POST">
        <table class="tbl-50">
            <tr>
                <td>Full Name</td>
                <td>
                    <input type="text" name="full_name" placeholder="Enter your name">
                </td>
            </tr>
            <tr>
                <td>Username</td>
                <td>
                    <input type="text" name="username" placeholder="Enter your username">
                </td>
            </tr>
            <tr>
                <td>Password</td>
                <td>
                    <input type="password" name="password" placeholder="Enter your password">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="Add Admin" class="btn-primary">

                </td>
            </tr>
        </table>
</div>


<?php include('partials/footer.php')?>
<?php
    //process the value from form and save it in database
    //check whether the button is clicked or not
    if(isset($_POST['submit']))
    {

        //get the data from from
        $full_name=$_POST['full_name'];
        $username=$_POST['username'];
        $password=md5($_POST['password']);//password encryption with md5

        // sql query to save the data into database
        $sql = "INSERT INTO tbl_admin
         SET
            full_name='$full_name',
            username='$username',
            password='$password'
        ";
        //executing query and saving data into database
        $res = mysqli_query($conn, $sql) or die(mysqli_error());
        //check whether the (query is executed)data is inserted or not and display apporpiate msg
        if($res==TRUE){
            echo "Data inserted";

        }
        else{
            echo "FAiled to insert data";
        }
    }
?>