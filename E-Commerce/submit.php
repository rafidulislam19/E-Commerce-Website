<?php
require('config.php');


if(isset($_POST['stripeToken'])){
	\Stripe\Stripe::setVerifySslCerts(false);

	$token=$_POST['stripeToken'];

	$data=\Stripe\Charge::create(array(
		"amount"=>"30000000" ,
		"currency"=>"BDT",
		"description"=>"E-Commerce Website",
		"source"=>$token
	));

	
      header("Location:success.php?amount=$amount");
    
}
?>