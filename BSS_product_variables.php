	<style>
	h3 { margin: 0px; padding: 10px;}
	.postbox_inner {padding: 10px;}
	.button-primary{margin-top: 10px;}
	</style>
<div class="wrap">
<h2>Product variables</h2>
<div class="postbox">
	<h3>Current list</h3>
	
	<?php
	if(isset($_POST['BSS_add_variable']))
		{
		$option_headers = get_option(BSS_admin_product_options);
		$new_variable 	= $_POST['new_variable'];
		$BSS_admin_product_options = $new_variable.'^'.str_replace('product code','',$option_headers);
		update_option('BSS_admin_product_options',$BSS_admin_product_options);
		if(update_option)
			{
			$option_headers = get_option(BSS_admin_product_options);
			$option_titles = explode('^',$option_headers);
			$ptable=$wpdb->prefix . "postmeta";
			$row = $wpdb->get_results("SELECT * FROM $ptable WHERE meta_key='Product Options'");
			foreach($row as $row)
			{
			$new_meta_values = '^'.$row->meta_value;
			$ptable=$wpdb->prefix . "postmeta";
			$wpdb->query("UPDATE $ptable SET meta_value='".$new_meta_values."' WHERE meta_id='".$row->meta_id."'");
			}
		}
		}
	
	if(isset($_POST['BSS_edit_option']))
		{
		$option_headers = get_option(BSS_admin_product_options);
		$variable = $_POST['variable'];
		$old_variable = $_POST['old_variable'];
		$BSS_admin_product_options = str_replace($old_variable,$variable,$option_headers);
		update_option('BSS_admin_product_options',$BSS_admin_product_options);
		if(update_option)
			{
			$option_headers = get_option(BSS_admin_product_options);
			$option_titles = explode('^',$option_headers);
			}
		}
	
	if(!isset($_POST['BSS_add_variable']))
	{
	$option_headers = get_option(BSS_admin_product_options);
	$option_titles = explode('^',$option_headers);
	}
	?>
<?php	
	for($t=0; $t<=count($option_titles)-1; $t++)
	{
	if($option_titles[$t]=='product_code'){echo '<input type="readonly" value="'.ucfirst(str_replace('_'," ",($option_titles[$t]))).'"  style="margin: 10px;"/><br />';}
	elseif($option_titles[$t]=='price'){echo '<input type="readonly" value="'.ucfirst($option_titles[$t]).'"  style="margin: 10px;"/><br />';}
	elseif($option_titles[$t]=='stock'){echo '<input type="readonly" value="'.ucfirst($option_titles[$t]).'"  style="margin: 10px;"/><br />';}
	else
	{
	echo '<form method="post" action="" style="padding: 10px;">';
	echo '<input type="hidden" name="old_variable" value="'.$option_titles[$t].'" /> ';
	echo '<input type="text" name="variable" value="'.ucfirst($option_titles[$t]).'" /> 
	<input type="submit" name="BSS_edit_option" value="Edit" class="button-primary" /> ';
	
	echo '<br />';
	echo '</form>';
	}
	}
?>
</div>
<div class="postbox"> 
	<h3>Add product variables</h3>
	<form method="post" action="" style="padding: 10px; line-height: 1.3;">
		Variable name <input type="text" name="new_variable" value="" /> <input type="submit" name="BSS_add_variable" value="Add" class="button-primary" />
	</form>
	</div>
</div>