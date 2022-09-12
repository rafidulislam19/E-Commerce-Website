<!DOCTYPE html>
<?php
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
        
                <div class="products_box">
                    <?php
                    if(isset($_GET['pro_id'])) {
                        $product_id = $_GET['pro_id'];
                        global $con;
                        $get_pro = "select * from products where pro_id='$product_id'";
                        $run_pro = mysqli_query($con, $get_pro);
                        while ($row_pro = mysqli_fetch_array($run_pro)) {
                            $pro_id = $row_pro['pro_id'];
                            $pro_title = $row_pro['pro_title'];
                            $pro_price = $row_pro['pro_price'];
                            $pro_image = $row_pro['pro_image'];
                            $pro_desc = $row_pro['pro_desc'];
                            echo "
                                <div class='single_product'>
                                    <h3 style='padding-bottom:10px'>$pro_title</h3>
                                    <img src='admin/product_images/$pro_image' width='300' height='300'>
                                    <p> <b> Rs $pro_price/-  </b> </p>
                                    <p>$pro_desc</p> 
                                    <a href='index.php' style='float: left;text-decoration:none;color:black;'><button style='float: left;font-weight:bold; margin-top:20px;border-radius:20px;padding:5px'>Go Back</button></a>
                                    <a href='index.php?pro_id=$pro_id'><button style='float: right;font-weight:bold; margin-top:20px;border-radius:20px;padding:5px'>Add to Cart</button></a>
                                </div>
                        ";
                        }
                    }
                    ?>
                </div>

            </div>
        </div>

    </div>
</body>
</html>