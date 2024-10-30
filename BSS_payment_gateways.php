<div class="wrap">
<h2>Payment gateways</h2>
<form name="frm_payment_gateways" method="post" action="">
<label for="lbl_payment_gateway">Select payment gateway</label><select name="BSS_payment_gateway" id="lbl_payment_gateway" tabindex="1"><option>PayPal</option></select><br />
<label for="lbl_gateway_email">Your gateway e-mail address</label> <input type="text" name="BSS_gateway_email" id="lbl_gateway_email" value="E-mail address" tabindex="2" /><br />
<label for="lbl_default_currency">Default currency</label><select name="BSS_default_currency" id="lbl_default_currency" tabindex="3"><option>GBP</option><option>USD</option><option>EUR</option></select><br />
<input type="submit" value="Set Gateway" name="cmd_BSS_payment_gateway" tabindex="4" class="button-primary" />
</form>
<?php
	// PROCESS THE UPDATE	
	if(isset($_POST['cmd_BSS_payment_gateway']))
	{
	$BSS_payment_gateway 	= $_POST['BSS_payment_gateway'];
	$BSS_gateway_email 		= $_POST['BSS_gateway_email'];
	$BSS_default_currency	= $_POST['BSS_default_currency'];
	update_option('BSS_payment_gateway',$BSS_payment_gateway);
	update_option('BSS_gateway_email',$BSS_gateway_email);
	update_option('BSS_default_currency',$BSS_default_currency);
	if(update_option)
		{
		echo '<p><strong>Payment gateway information saved</strong></p>';
		}
	}
	// DISPLAY THE PAYMENT GATEWAY INFORMATION	
	echo '<h2>Current payment gateway information</h2>';
	echo get_option('BSS_payment_gateway');
	echo get_option('BSS_gateway_email');
	echo get_option('BSS_default_currency');
?>
</div>