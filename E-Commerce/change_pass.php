<?php
$err_msg = '';
$no_match_err = '';
if(isset($_POST['change_pass'])){
    $user = $_SESSION['customer_email'];
    $current_pass = $_POST['current_pass'];
    $new_pass = $_POST['new_pass'];
    $confirm_pass = $_POST['confirm_pass'];

    $sel_pass = "select * from customers where cust_pass = '$current_pass' 
                  AND cust_email='$user'";
    $run_pass = mysqli_query($con,$sel_pass);
    $check_pass = mysqli_num_rows($run_pass);
    if($check_pass == 0){
        $err_msg = 'Your current Password is wrong';
    }else {
        if ($new_pass != $confirm_pass) {
            $no_match_err = 'Confirm Password do not match!';
        }else{
            $update_pass = "update customers set cust_pass = '$new_pass' where cust_email='$user'";
            $run_update = mysqli_query($con,$update_pass);
            header('location: my_account.php');
        }
    }
}
?>

<div><b style="color: red"><?php echo $err_msg;?></b></div>
<div><b style="color: red"><?php echo $no_match_err;?></b></div>

<form action="" method="post" style="padding-left:350px;padding-top: 130px">

    <table width="500" align="center" bgcolor="whitesmoke" style="padding:40px;border-radius:60px">
    <tr align="center">
                <td colspan="2"><h2 style="color:#187eae;">Change Your Password<br><br></h2></td>
            </tr>
        <tr>
            <td align="right" style="color:#187eae;"><b>Enter Current Password:</b></td>
            <td><input style="padding: 2px 10px;background:whitesmoke;color:black;cursor: pointer;border-radius: 20px;" type="password" name="current_pass" required></td>
        </tr>
        <tr>
            <td align="right" style="color:#187eae;"><b>Enter New Password:</b></td>
            <td> <input style="padding: 2px 10px;background:whitesmoke; color:black;cursor: pointer;border-radius: 20px;" type="password" name="new_pass" required></td>
        </tr>
        <tr>
            <td align="right" style="color:#187eae;"><b>Confirm Password:</b></td>
            <td><input style="padding: 2px 10px;background:whitesmoke; color:black;cursor: pointer;border-radius: 20px;"  type="password" name="confirm_pass" required></td>
        </tr>
        <tr align="center">
            <td colspan="3"><input style="padding: 2px 10px;background:#187eae;; color:whitesmoke;cursor: pointer;border-radius: 20px; margin-top:20px;" type="submit" name="change_pass" value="Change Password"></td>
        </tr>

    </table>
</form>
