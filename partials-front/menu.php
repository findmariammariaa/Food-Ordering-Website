<?php include('config/constants.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- Navbar Section Starts Here -->
    <section class="navbar">
        <div class="container">
            <div class="logo">
            </div>
            <div class="logo">
                <a href="#" title="Logo1">
                    <img src="images/logo1.png"alt="Restaurant Logo" class="img-responsive">
                </a>
    
            </div>
            <div class="logo">
                <a href="#" title="Logo2">
                    <img src="images/logo2.png"alt="Restaurant Logo" class="img-responsive">
                </a>
    
            </div>
            <br/><br/>
            <div class="logo">
                <a href="#" title="Logo3">
                    <img src="images/logo3.png"alt="Restaurant Logo" class="img-responsive" line-height: 180px;>
                </a>
    
            </div>


            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="<?php echo SITEURL; ?>">Home</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>categories.php">Categories</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>foods.php">Foods</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>">Contact</a>
                    </li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Navbar Section Ends Here -->


