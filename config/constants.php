<?php


        //start the session
        session_start();
        //create constatnts to store the non repeating values
        define('SITEURL','http://localhost/food_order/');
        define('LOCALHOST','localhost');
        define('DB_USERNAME','root');
        define('DB_PASSWORD','');
        define('DB_NAME','food-order');

        $conn = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error());//database connetion
        $db_select = mysqli_select_db($conn,DB_NAME)  or die(mysqli_error());
?>