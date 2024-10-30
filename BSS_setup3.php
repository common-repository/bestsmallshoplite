<h2>Step 2 - Some trading information</h2>
<blockquote>
<div class="BSS_postbox">
	<?php
	if(isset($_POST['cmd_BSS_registration']))
	{
	$BSS_no_nums		= $_POST['BSS_no_nums'];
	$BSS_shop_name 		= $_POST['BSS_shop_name'];
	$BSS_contact_person = $_POST['BSS_contact_person'];
	$BSS_address 		= $_POST['BSS_address'];
	$BSS_contact_email 	= $_POST['BSS_contact_email'];
	$BSS_contact_tel 	= $_POST['BSS_contact_tel'];
	update_option('BSS_shop_name',$BSS_shop_name);
	update_option('BSS_contact_person',$BSS_contact_person);
	update_option('BSS_address',$BSS_address);
	update_option('BSS_contact_email',$BSS_contact_email);
	update_option('BSS_shop_telephone',$BSS_contact_tel);
	if($BSS_no_nums=='1')
		{
		update_option('BSS_registration_number','-');
		update_option('BSS_vat_number','-');
		}
		else
		{
		$BSS_registration_number 	= $_POST['BSS_registration_number'];
		$BSS_vat_number 			= $_POST['BSS_vat_number'];
		update_option('BSS_registration_number',$BSS_registration_number);
		update_option('BSS_vat_number',$BSS_vat_number);
		}
	}
	if(get_option('BSS_vat_number'))
	{
	echo '<h3>Registration numbers set up</h3>';
	}
	else
	{
	?>
	<h3>Trading details</h3>
	<div class="postbox_inner">
	<form name="frm_setup4" method="post" action="">
	<div class="BSS_label">Company and/or trading name</div><input type="text" name="BSS_shop_name" />
	<br />
	<div class="BSS_label">Contact person</div><input type="text" name="BSS_contact_person" />
	<br />
	<div class="BSS_label">Address</div><textarea name="BSS_address"></textarea>
	<br />
	<div class="BSS_label">Telephone number</div><input type="text" name="BSS_contact_tel" />
	<br />
	<div class="BSS_label">E-mail address</div><input type="text" name="BSS_contact_email" />
	<br />
	<input type="checkbox" name="BSS_no_nums" value="1" /> I/we do not have a Company registration number and/or are not registered for salestax/VAT
	<p>
	<div class="BSS_label">Company registration number</div><input type="text" name="BSS_registration_number" />
	<br />
	<div class="BSS_label">Company salestax/VAT number</div><input type="text" name="BSS_vat_number" />
	<br />
	<input type="submit" value="Set trading details" name="cmd_BSS_registration" tabindex="4" class="button-primary" />
	</form>
	</div>
	<?php } ?>
	
	</div>
</blockquote>