	
	<h2>Step 3 - Just this bit to go</h2>
	<blockquote>
	<div class="BSS_postbox">
	<?php
	if(isset($_POST['cmd_BSS_email']))
	{
	$BSS_email 	= $_POST['fld_email'];
	update_option('BSS_shop_email',$BSS_email);
	}
	if(get_option('BSS_shop_email'))
	{
	echo '<h3>E-mail message set up</h3>';
	}
	else
	{
	?>
	<h3>E-mail message</h3>
	<div class="postbox_inner">
		<form name="frm_setup5" method="post" action="">
		<div class="BSS_label">E-mail message</div><textarea name="fld_email" cols="40" rows="5"></textarea>
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
	update_option('BSS_terms',$BSS_terms);
	}
	if(get_option('BSS_terms'))
	{
	echo '<h3>Terms & conditions set up</h3>';
	}
	else
	{
	?>
	<h3>Terms & conditions</h3>
	<div class="postbox_inner">
	<form name="frm_setup5" method="post" action="">
	<?php the_editor($content_to_load); ?>
	<br />
	<input type="submit" value="Set terms &amp; conditions" name="cmd_BSS_terms" tabindex="4" class="button-primary" />
	</form>
	</div>
	<?php } ?>
	
	</div>
	</blockquote>
	
	<?php
	if((get_option('BSS_terms'))&&(get_option('BSS_shop_email'))) {
	$subject = "Activating BestSmallShopLite for ".get_option('blogname');
	$Enquiry = "Hello ";
	$Enquiry.= "\n\nThank you for activating BestSmallShopLite";
	$Enquiry.= "\n\nWe hope you enjoy using BestSmallShopLite on for ".get_option('blogname')." and that it will be a success for you";
	$Enquiry.= "\n\nIf you have any help with your BestSmallShopLite please contact us at  russell@parotkefalonia.com";
	$Enquiry.= "\n\nWe have started a forum for BestSmallShopLite users here: http://www.parotkefalonia.com/phpbb A link to our forum and we invite you to join.";
	$Enquiry.= "\n\nFor your information, this is the data you entered whilst activating BestSmallShopLite.";
	$Enquiry.= "\n\n".get_option('BSS_shop_name');
	$Enquiry.= "\n".get_option('BSS_contact_person');
	$Enquiry.= "\n".get_option('BSS_address');
	$Enquiry.= "\n".get_option('BSS_contact_email');
	$Enquiry.= "\n".get_option('BSS_shop_telephone');
	$Enquiry.= "\n".get_option('siteurl');
	$Enquiry.= "\n\nIf having activated BestSmallShopLite you feel that our Plugin is not quiet for you and that you need it to do a bit more then please contact us.  We are happy to customise your plugin to meet your needs.  If we feel these changes are a benefit to other users we will not make any charge, otherwise we would make a nominal (which we would agree in advance) charge.  Do not hesitate to contact us we are here to help, we want you to use BestSmallShopLite and for you to have a tool that truely meets your requirements.";
	$Enquiry.= "\n\nBestSmallShopLite addons/extras";
	$Enquiry.= "\n\nWe offer a range of addon/extras for you BestSmallShopLite plugin please check them out when you use your Plugin, they are on the welcome scren.";
	
	mail ('russell@parotkefalonia.com', $subject, $Enquiry, $headers); 
	mail (get_option('BSS_shop_email'), $subject, $Enquiry, $headers); 

		
	update_option('BSS_setup','yes'); ?>
	<h2>Congratulations, you have set up your BestSmallShopLite plugin.</h2>
	You can now add products and start to trade.
	<p>
	<a href=""><input typye="button" name="setup" value="Continue" class="BSS_setup_but"/></a>
	<?php } ?>