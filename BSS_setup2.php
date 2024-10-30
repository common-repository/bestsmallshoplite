<blockquote>
<div class="BSS_postbox">
	<?php
	if(isset($_POST['cmd_BSS_list_variables']))
	{
	$product_options = $_POST['product_options'];
	for($q1=1; $q1<=$product_options; $q1++)
	{
	$fld_list_variables[] = $_POST[fld_list_variables][$q1];
	}
	
	$BSS_admin_product_options 	= implode('^',$fld_list_variables).'^product_code^price^stock';
	if($BSS_admin_product_options)
		{
		update_option('BSS_admin_product_options',$BSS_admin_product_options);
		}
	}
	
	if(get_option('BSS_admin_product_options'))
	{
	echo '<h3>Product variables set up</h3>';
	}
	else
	{
	echo '<h3>Product variables</h3>
	<div class="postbox_inner">';
	if(isset($_POST['cmd_BSS_variables']))
	{
	$fld_variables = $_POST['fld_variables'];
	echo '<form name="frm_setup2a" method="post" action="">';
	echo '<input type="hidden" name="product_options" value="'.$fld_variables.'"/>';
	for($v=1; $v<=$fld_variables; $v++)
	{
	echo '<div class="BSS_label">Variable name</div><input type="text" name="fld_list_variables['.$v.']" size="20" />
	<br />';
	}
	echo '<input type="submit" value="Number of variables" name="cmd_BSS_list_variables" tabindex="4" class="button-primary" />';
	echo '</form>';
	}
	else
	{?>	
	<form name="frm_setup2" method="post" action="">
	<div class="BSS_label">Number of variables to set</div>
	<input type="text" name="fld_variables" size="4" /> By variables we mean product atributes like colour, size.
	<br />
	<input type="submit" value="Number of variables" name="cmd_BSS_variables" tabindex="4" class="button-primary" />
	</form>
	<?php 
	}
	echo '</div>';
	}
	?>
</div>
</blockquote>
<?php if(get_option('BSS_admin_product_options')) {?>
<h2>Now that wasn't too bad was it? lets continue</h2>
<a href="?page=bestsmallshoplite/BestSmallShopLite.php&amp;setup1=1;"><input typye="button" name="setup" value="Continue" class="BSS_setup_but"/></a>
<?php } ?>