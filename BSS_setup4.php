<blockquote>
<div class="BSS_postbox">
	<?php
	if(isset($_POST['cmd_BSS_payment_gateway']))
	{
	$BSS_payment_gateway 	= $_POST['BSS_payment_gateway'];
	$BSS_gateway_email 		= $_POST['BSS_gateway_email'];
	$BSS_default_currency	= $_POST['BSS_default_currency'];
	update_option('BSS_payment_gateway',$BSS_payment_gateway);
	update_option('BSS_gateway_email',$BSS_gateway_email);
	update_option('BSS_default_currency',$BSS_default_currency);
	}
	if(get_option('BSS_default_currency'))
	{
	echo '<h3>Payment methods set up</h3>';
	}
	else
	{
	?>
	<h3>Payments</h3>
	<div class="postbox_inner">
	<form name="frm_setup3" method="post" action="">
	<div class="BSS_label"><label for="lbl_payment_gateway">Select payment gateway</label></div>
	<select name="BSS_payment_gateway" id="lbl_payment_gateway" tabindex="1">
	<option>PayPal</option>
	</select><br />
	<div class="BSS_label"><label for="lbl_gateway_email">Your gateway e-mail address</label></div>
	<input type="text" name="BSS_gateway_email" id="lbl_gateway_email" value="E-mail address" tabindex="2" /><br />
	<div class="BSS_label"><label for="lbl_default_currency">Default currency</label></div>
	<select name="BSS_default_currency" id="lbl_default_currency" tabindex="3">
	<option>GBP</option><option>USD</option><option>EUR</option>
	</select><br/>
	<input type="submit" value="Set Gateway" name="cmd_BSS_payment_gateway" tabindex="4" class="button-primary" />
	</form>
	<?php }
	?>

</blockquote>
<div class="wrap">
<?php if(get_option('BSS_default_currency')) {?>
<h2>Nearly done -  lets continue</h2>
<a href="?page=bestsmallshoplite/BestSmallShopLite.php&amp;setup2=1;"><input typye="button" name="setup" value="Continue" class="BSS_setup_but"/></a>
<?php } ?>
</div>