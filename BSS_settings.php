<h2>Settings</h2>
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
	$updated = update_option('BSS_shop_telephone',$BSS_contact_tel);
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
		$updated = update_option('BSS_vat_number',$BSS_vat_number);
		}
	}
	if($updated)
	{
	echo '<h3>Trading details set up</h3>';
	}
	else
	{
	?>
<h3>Trading details</h3>
<div class="postbox_inner">
<form name="frm_setup4" method="post" action="">
<div class="BSS_label">Company and/or trading name</div><input type="text" name="BSS_shop_name" value="<?php echo get_option('BSS_shop_name'); ?>" />
<br />
<div class="BSS_label">Contact person</div><input type="text" name="BSS_contact_person" value="<?php echo get_option('BSS_contact_person');?>" />
<br />
<div class="BSS_label">Address</div><textarea name="BSS_address"><?php echo get_option('BSS_address'); ?></textarea>
<br />
<div class="BSS_label">Telephone number</div><input type="text" name="BSS_contact_tel" value="<?php echo get_option('BSS_shop_telephone'); ?>" />
<br />
<div class="BSS_label">E-mail address</div><input type="text" name="BSS_contact_email" value="<?php echo get_option('BSS_contact_email');?>" />
<br />
<input type="checkbox" name="BSS_no_nums" value="1" /> I/we do not have a Company registration number and/or are not registered for salestax/VAT
<p>
<div class="BSS_label">Company registration number</div><input type="text" name="BSS_registration_number" value="<?php echo get_option('BSS_registration_number');?>" />
</p><br />
<div class="BSS_label">Company salestax/VAT number</div><input type="text" name="BSS_vat_number" value="<?php echo get_option('BSS_vat_numbe');r?>" />
<br />
<input type="submit" value="Set trading details" name="cmd_BSS_registration" tabindex="4" class="button-primary" value="" />
</form>
</div>
	<?php } ?>
</div>
</blockquote>
	
<blockquote>
<div class="BSS_postbox">
<?php
	if(isset($_POST['cmd_BSS_email']))
	{
	$BSS_email 	= $_POST['fld_email'];
	$updated_email = update_option('BSS_shop_email',$BSS_email);
	
	}
	if($updated_email)
	{
	echo '<h3>E-mail message set up</h3>';
	}
	else
	{
	?>
<h3>E-mail message</h3>
<div class="postbox_inner">
<form name="frm_setup5" method="post" action="">
<div class="BSS_label">E-mail message</div><textarea name="fld_email" cols="40" rows="5"><?php echo get_option('BSS_shop_email');?></textarea>
<br />
<input type="submit" value="Set e-mail" name="cmd_BSS_email" tabindex="4" class="button-primary" />
</form>
</div>
<?php } ?>
</div>
</blockquote>

<blockquote>
<div class="BSS_postbox">
<?php
	if(isset($_POST['cmd_BSS_terms']))
	{
	$BSS_terms 	= $_POST['content'];
	$updated_terms = update_option('BSS_terms',$BSS_terms);
	}
	if($updated_terms)
	{
	echo '<h3>Terms & conditions set up</h3>';
	}
	else
	{
	?>
<h3>Terms & conditions</h3>
	<div class="postbox_inner">
	<form name="frm_setup5" method="post" action="">
	<?php the_editor(get_option('BSS_terms')); ?>
	<br />
	<input type="submit" value="Set terms &amp; conditions" name="cmd_BSS_terms" tabindex="4" class="button-primary" />
	</form>
	</div>
	<?php } ?>
	</div>
	</blockquote>