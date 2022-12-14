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
                <?php
                global $con;
                $ip = getIp();
                if(isset($_POST['update_cart'])){
                    
                    for($i =0; $i< sizeof($_POST['product_id']); $i++){
                        $pro_id = $_POST['product_id'][$i];
                        $qty = $_POST['qty'][$i];
                        if($qty > 0) {
                            $update_qty = "update cart set qty='$qty' where p_id='$pro_id' AND ip_add='$ip'";
                            $run_qty = mysqli_query($con, $update_qty);
                        }
                    }
                    if(isset($_POST['remove'])) {
                        foreach ($_POST['remove'] as $remove_id) {
                            $del_pro = "delete from cart where p_id='$remove_id' AND ip_add='$ip'";
                            $run_del = mysqli_query($con, $del_pro);
                        }
                    }
                    header('location: '.$_SERVER['PHP_SELF']);
                }
                if(isset($_POST['continue'])){
                    header('location: index.php');
                }
                ?>
                <div>
                    <?php cart(); ?>


                </div>
                <div class="products_box">
                    <br>
                    <form action="" method="post" enctype="multipart/form-data">
                        <table align="center" width="1200px" bgcolor="whitesmoke" style="padding: 40px; border-radius:50px;color:#187eae">
                            <tr align="center" >
                                <th> Remove </th>
                                <th> Product(s) </th>
                                <th> Quantity </th>
                                <th> Unit Price </th>
                                <th> Items Total </th>
                            </tr>
                            <?php
                                $ip = getIp();
                                $total = 0;
                                $sel_price = "select * from cart where ip_add = '$ip'";
                                $run_price = mysqli_query($con,$sel_price);
                                while($cart_row = mysqli_fetch_array($run_price)){
                                    $pro_id = $cart_row['p_id'];
                                    $pro_qty = $cart_row['qty'];
                                    $pro_price = "select * from products where pro_id = '$pro_id'";
                                    $run_pro_price = mysqli_query($con, $pro_price);
                                    while ($pro_row = mysqli_fetch_array($run_pro_price)){
                                        $pro_title = $pro_row['pro_title'];
                                        $pro_image = $pro_row['pro_image'];
                                        $pro_price = $pro_row['pro_price'];
                                        $pro_price_all_items = $pro_price * $pro_qty;
                                        $total += $pro_price_all_items;
                                        ?>
                                        <tr align="center">
                                            <td><input type="checkbox" name="remove[]"
                                                       value="<?php echo $pro_id; ?>"></td>
                                            <td><?php echo $pro_title; ?> <br>
                                                <img src="admin/product_images/<?php echo $pro_image; ?>"
                                                     width="60" height="60">
                                            </td>
                                            <td><input size="2" name="qty[]" value="<?php echo $pro_qty;?>">
                                                <input name="product_id[]" type="hidden" value="<?php echo $pro_id;?>">
                                            </td>
                                            <td><?php echo "BDT " . $pro_price . "/-"; ?></td>
                                            <td name="total"><?php echo "BDT " . $pro_price_all_items . "/-"; ?></td>
                                        </tr>
                                        <?php
                                    }
                                }
                            ?>

                            <tr align="right">
                                <td colspan="4"><b>Sub Total:</b></td>
                                <td><?php echo "BDT ".$total."/-"; ?></td>
                            </tr>
                            <tr align="center">
                                <td colspan="2"><input style="padding: 2px 10px;background:#187eae; color:whitesmoke;cursor: pointer;border-radius: 20px; margin-top:20px" type="submit" name="update_cart" value="Update Cart"></td>
                                <td><input style="padding: 2px 10px;background:#187eae; color:whitesmoke;cursor: pointer;border-radius: 20px; margin-top:20px" type="submit" name="continue" value="Continue Shopping"></td>
                                <td>
                                    <button style="padding: 2px 10px;background:#187eae; cursor: pointer;border-radius: 20px; margin-top:30px;">
                                        <a style="text-decoration: none;color:whitesmoke;" href="checkout.php">
                                            Checkout</a>
                                    </button>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>

            </div>
        </div>
        <div id="footer">
            <h3 style="text-align:center; padding-top:30px;">&copy; 2022 by www.ecommerce.com</h3>
        </div>
    </div>
</body>
</html>