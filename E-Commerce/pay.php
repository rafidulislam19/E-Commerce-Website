<?php
require('config.php');

?>

<div style="background: white; background-opacity:20%; margin:70px;width:400px;margin-left:400px;border-radius: 60px ">

<form action="submit.php" method="post" style="align-items: center; padding:50px; padding-left: 135px ;padding-top:100px;">
	<script
		src="https://checkout.stripe.com/checkout.js" class="stripe-button"
		data-key="<?php echo $publishableKey?>"
		data-amount="30000000"
		data-name="E-Commerce Website"
		data-description="E-Commerce Website"
		data-image=""
		data-currency="BDT"
		data-email=""
	>
	</script>

</form>


<div>
	<button type="submit" style="margin-left: 130px; margin-bottom: 150px; padding: 8px;border-radius: 10px;font-size: 15px;background: #068FDE; " ><a style="text-decoration: none; color: white;font-weight: bold;" href="confirmation.php">Home Delivery</a> </button>
</div>

</div>