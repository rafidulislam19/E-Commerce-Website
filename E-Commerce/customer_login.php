<?php
if(isset($_POST['login']))
{
    global $con;
    $ip = getIp();
    $c_email = $_POST['email'];
    $c_pass = $_POST['pass'];
    $sel_c = "select * from customers where cust_pass = '$c_pass' AND cust_email = '$c_email'";
    $run_c = mysqli_query($con,$sel_c);
    $check_c = mysqli_num_rows($run_c);
    if($check_c==0){
        header('location:'.$_SERVER['PHP_SELF']);
        exit();
    }
    $sel_cart = "select * from cart where ip_add='$ip'";
    $run_cart = mysqli_query($con,$sel_cart);
    $check_cart = mysqli_num_rows($run_cart);
    if($check_c > 0 && $check_cart ==0){
        $_SESSION['customer_email'] = $c_email;
        header('location: my_account.php');
    }else{
        echo "here2";
        $_SESSION['customer_email'] = $c_email;
        header('location: my_account.php');
    }
}
?>
<div>
    <form method="post" action="" style="padding-left:350px;padding-top: 50px">
        <table width="500" align="center" bgcolor="whitesmoke" style="padding:40px;border-radius:60px">
            <tr align="center">
                <td colspan="2"><h2 style="color:#187eae;">Login or Register to Buy! <br><br></h2></td>
            </tr>
            <tr>
                <td align="right" style="color:#187eae;"><b>Email:  </b></td>
                <td><input style="padding: 2px 10px;background:whitesmoke;color:black;;cursor: pointer;border-radius: 20px;" type="text" name="email"  placeholder="Enter email" required></td>
            </tr>
            <tr>
                <td align="right" style="color:#187eae;"><b>Password:  </b></td>
                <td><input style="padding: 2px 10px;background:whitesmoke; color:black;cursor: pointer;border-radius: 20px;" type="password" name="pass" placeholder="Enter password" required></td>
            </tr>
    
            <tr align="center">
                <td colspan="2" style="padding-top:10px";><input style="padding: 2px 10px;background:#187eae;; color:whitesmoke;cursor: pointer;border-radius: 20px; margin-top:20px;" type="submit" name="login" value="Login"></td>
            </tr>
        </table>
        <h2 style="padding-left: 130px;padding-top: 30px;float: left;">
            <a style="text-decoration: none; color:white;" href="customer_register.php" href="customer_register.php">New? Register Here</a>
        </h2>
    </form>
</div>
