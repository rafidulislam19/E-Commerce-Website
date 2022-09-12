<!DOCTYPE html>
<?php
session_start();
require "functions/functions.php";
?>

<?php
if(isset($_POST['register'])){
    global $con;
    $ip = getIp();
    $c_name = $_POST['c_name'];
    $c_email = $_POST['c_email'];
    $c_pass = $_POST['c_pass'];
    $c_image = $_FILES['c_image']['name'];
    $c_image_tmp = $_FILES['c_image']['tmp_name'];
    $c_country = $_POST['c_country'];
    $c_city = $_POST['c_city'];
    $c_contact = $_POST['c_contact'];
    $c_address = $_POST['c_address'];

    move_uploaded_file($c_image_tmp,"customer/customer_images/$c_image");

    $insert_c = "insert into customers (cust_ip,cust_name,cust_email,cust_pass,cust_country,cust_city,cust_contact,cust_address,cust_image) 
                  values ('$ip','$c_name','$c_email','$c_pass','$c_country','$c_city','$c_contact','$c_address','$c_image')";
    $run_c = mysqli_query($con,$insert_c);
    $sel_cart = "select * from cart where ip_add='$ip'";
    $run_cart = mysqli_query($con,$sel_cart);
    $check_cart = mysqli_num_rows($run_cart);
    if($check_cart==0){
        $_SESSION['customer_email'] = $c_email;
        header('location: my_account.php');
    }
    else {
        $_SESSION['customer_email'] = $c_email;
        header('location: checkout.php');
    }
}
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
                <li><a href="customer/account.php">My Account</a></li>
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
                <div>
                    <?php cart(); ?>

                </div>

                <div style="align-items:center; padding:10px;">
                    <form action="customer_register.php" method="post" enctype="multipart/form-data" style="color:#187eae; padding:80px; padding-left:120px;">
                        <table align="center" width="1050px" bgcolor="whitesmoke" style="border-radius:70px;padding-bottom:30px;padding-top:20px;">
                            <tr align="center">
                                <td colspan="2"><h2 style="padding-top:10px;padding-bottom:20px">Create an Account </h2></td>
                            </tr>
                            <tr>
                                <td align="right"><b>Name:</b>  </td>
                                <td><input style="width:80%;padding: 2px 10px;background:whitesmoke; color: black;cursor: pointer;border-radius: 20px;" name="c_name" required></td>
                            </tr>
                            <tr>
                                <td align="right"><b>Email:</b>  </td>
                                <td>
                                    <input style="width:80%;padding: 2px 10px;background:whitesmoke; color:black;cursor: pointer;border-radius: 20px;" name="c_email" onkeyup="checkEmail(this.value)" required>
                                    <span id="hint"></span>
                                </td>
                            </tr>
                            <tr>
                                <td align="right"><b>Password:</b> </td>
                                <td><input style="width:80%;padding: 2px 10px;background:whitesmoke; color:black;cursor: pointer;border-radius: 20px;" type="password" name="c_pass" required></td>
                            </tr>
                            <tr>
                                <td align="right"><b>Image:</b>  </td>
                                <td><input type="file" name="c_image" required></td>
                            </tr>
                            <tr>
                                <td align="right">
                            <b>Country:</b>  </td>
                                <td>
                                    <select name="c_country">
                                    <option>Select a Country </option>
                                        <option>Bangladesh </option>
                                        <option>Afghanistan </option>
                                        <option>India </option>
                                        <option>Pakistan</option>
                                        <option>China</option>
                                        <option>Canada</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td align="right"><b>City:</b>  </td>
                                <td><input style="width:80%;padding: 2px 10px;background:whitesmoke; color:black;cursor: pointer;border-radius: 20px;" name="c_city" required></td>
                            </tr>
                            <tr>
                                <td align="right"><b>Contact:</b>  </td>
                                <td><input style="width:80%;padding: 2px 10px;background:whitesmoke; color:black;cursor: pointer;border-radius: 20px;" name="c_contact" required pattern=".*"></td>
                            </tr>
                            <tr>
                                <td align="right"><b>Address:</b>  </td>
                                <td><input style="width:80%;padding: 2px 10px;background:whitesmoke; color: black;cursor: pointer;border-radius: 20px;" name="c_address" required></td>
                            </tr>
                            <tr align="center">
                                <td colspan="2"><input style="margin-top:15px;padding: 5px 10px; background:#187eae ; color: whitesmoke;cursor: pointer; border-radius: 30px;" type="submit" name="register" value="Create Account"></td>
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
    <script>
        function checkEmail(email) {
            if(email==''){
                document.getElementById('hint').innerHTML = "";
            }
            else {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById('hint').innerHTML = this.responseText;
                    }
                };
                xhttp.open("GET", "check_email.php?e="+email);
                xhttp.send();
            }
        }
    </script>
</body>
</html>
