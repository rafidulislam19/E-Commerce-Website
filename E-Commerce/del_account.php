<?php
$user = $_SESSION['customer_email'];
if(isset($_POST['yes'])){
    $del_cust = "delete  from customers where cust_email='$user'";
    mysqli_query($con,$del_cust);
    header('location: logout.php');
}
if(isset($_POST['no'])){
    header('location: my_account.php');
}
?>
<br>
<h2 style="text-align: center;padding-top:150px">Do you really want to DELETE your account? </h2>
<br>
<form action="" method="post">
    <input style="padding: 2px 10px;background:whitesmoke; color:#187eae;cursor: pointer;border-radius: 20px; margin-top:20px;" type="submit" name="yes" value="Yes I want">
    <input style="padding: 2px 10px;background:whitesmoke; color:#187eae;cursor: pointer;border-radius: 20px; margin-top:20px;" type="submit" name="no" value="No I was Joking">
</form>