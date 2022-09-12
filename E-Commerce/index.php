<!DOCTYPE html>
<?php
session_start();
require "functions/functions.php";
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Online Shop</title>
       <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="style.css">

</head>
<body>
    <div class="main_wrapper">

        <div class="menubar">

           <div class="logo">
               <a href="index.php"><img src="images/e commerce.png" width="80px" style="border-radius:35%"> </a> 
            </div>

            <nav>
            <ul id="menu">
                <li><a href="index.php">Home</a></li>
                <li><a href="all_products.php">All Products</a></li>
                <li><a href="my_account.php">My Account</a></li>
                <li><a href="cart.php">Cart</a></li>
                <li><a href="contact.php">Contact Us</a></li>
            </ul>
            </nav>
            <div id="form">
                <form method="get" action="results.php">
                    <input type="text" name="user_query" placeholder="Search products" class="input1" id="search">
                    <input type="submit" name="search" value="Search" class="input2">
                </form>
            </div>
        </div>
      
        <div class="content_wrapper">
            <div id="sidebar">
                <div class="sidebar_title">Categories </div>
                <ul class="cats">
                    <?php getCats(); ?>
                </ul>
                <div class="sidebar_title">Brands </div>
                <ul class="cats">
                    <?php getBrands(); ?>
                </ul>
            </div>
            <div id="content_area">
                <div class="shopping_cart">
                    <?php cart(); ?>
                    <span style="float: right;
                    font-size: 18px; padding: 5px;line-height: 40px;">
                        <?php
                        if(!isset($_SESSION['customer_email']))
                            echo "Welcome guest!";
                        else
                            echo "Welcome ".$_SESSION['customer_email'];
                         ?>
                        <b>
                            Shopping Cart - </b>
                        Total Price: <?php total_price(); ?>
                        <button><a style='text-decoration:none;color: black;font-weight:bold;padding: 2px 10px;' href="cart.php"> Go to Cart</a></button>

                        <?php
                            if(!isset($_SESSION['customer_email'])){
                                echo "<button style='padding: 2px 10px;background:whitesmoke; cursor: pointer;border-radius: 20px;font-weight:bold'><a style='text-decoration:none;color:#187eae;' href='checkout.php'>Login</a></button>";
                            }
                            else{
                                echo "<button style='padding: 2px 10px;background:whitesmoke; cursor: pointer;border-radius: 20px;'><a style='text-decoration:none;color:#187eae;font-weight:bold' href='logout.php'>Logout</a></button>";
                            }
                        ?>
                    </span>
                </div>
                <div class="products_box">
                    <?php getPro(); ?>
                </div>

            </div>
        </div>
        <div id="footer">
            <h3 style="text-align:center; padding-top:30px;">&copy; 2022 by www.ecommerce.com</h3>
        </div>

    </div>

</body>
</html>