<h2>Step 1 - Your how your products are displayed</h2>
<blockquote>
<div class="BSS_postbox">
	<?php
	if(isset($_POST['cmd_BSS_page']))
	{
	include 'BSS_setup_processes.php';
	}
	
	if(get_option('BSS_product_category_name'))
	{
	echo '<h3>Page name &amp; Category name set up</h3>';
	}
	else
	{ ?>
	<h3>Page name &amp; Category name</h3>
	<div class="postbox_inner">
	<form name="frm_setup1" method="post" action="">
		<div class="BSS_label"><label for="id_page_name">Page name</label></div>
		<input type="text" id="id_page_name" name="fld_page_name"  tabindex="1"/> This is the page on which your products will be displayed
		<br />
		<div class="BSS_label"><label for="id_category_name">Category name</label></div>
		<input type="text" id="id_category_name" name="fld_category_name" tabindex="2"/> A category in which your products will be displayed
		<br />
		<input type="submit" value="Page name &amp; Category name" name="cmd_BSS_page" tabindex="3" class="button-primary" />
	</form>
	</div>
	<?php
	}
	?>
</div>
</blockquote>