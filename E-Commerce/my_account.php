<!DOCTYPE html>
<?php
session_start();
require "functions/functions.php";
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Online Shop</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
 
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
                <input type="text" name="user_query" placeholder="Search products" class="input1">
                <input type="submit" name="search" value="Search" class="input2">
            </form>
        </div>
    </div>
    <div class="content_wrapper">
        <div id="sidebar">
            <div class="sidebar_title">My Account</div>
            <ul class="cats">
                <?php
                    $user = $_SESSION['customer_email'];
                    $get_img = "select * from customers where cust_email='$user'";
                    $run_img = mysqli_query($con, $get_img);
                    $row_img = mysqli_fetch_array($run_img);
                    $c_image = $row_img['cust_image'];
                    $c_name = $row_img['cust_name'];
                    echo "<img src='customer/customer_images/$c_image' width='150' height='150' 
                    style='border: 3px solid white;border-radius: 50%; margin-top:30px;margin-bottom:30px'>"
                ?>
                <li><a href="my_account.php?edit_account">Edit Account</a></li>
                <li><a href="my_account.php?change_pass">Change Password</a></li>
                <li><a href="my_account.php?del_account">Delete Account</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
        <div id="content_area">
            <div>
                <?php cart(); ?>
                <span style="float: right;
                    font-size: 18px; padding: 5px;line-height: 40px;">
                    <?php
                        if(isset($_SESSION['customer_email'])){
                            
                            echo "<button style='padding: 2px 10px;background:whitesmoke; cursor: pointer;border-radius: 20px;margin:20px'><a style='text-decoration:none;color:#187eae;font-weight:bold;font-size:16px ' href='logout.php'>Logout</a></button>";
                        } else {
                            header('location: index.php');
                        }
                    ?>
                    </span>
            </div>
            <div class="products_box">
                <?php
                    if(!isset($_GET['my_orders'])) {
                        if (!isset($_GET['edit_account'])) {
                            if (!isset($_GET['change_pass'])) {
                                if (!isset($_GET['del_account'])) {
                                    echo "<h1 style='padding: 20px; padding-top:200px'> Welcome  $c_name !</h1>";
                    
                                }
                            }
                        }
                    }
                ?>
                <?php
                    if(isset($_GET['edit_account'])){
                        include ('edit_account.php');
                    }else
                    if(isset($_GET['change_pass'])){
                        include ('change_pass.php');
                    }else
                    if(isset($_GET['del_account'])){
                        include ('del_account.php');
                    }

                ?>


            </div>

        </div>
    </div>
    <div id="footer">
            <h3 style="text-align:center; padding-top:30px;">&copy; 2022 by www.ecommerce.com</h3>
        </div>
</div>
</body>
</html>