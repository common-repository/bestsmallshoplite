	<style>
	h3 { margin: 0px; padding: 10px;}
	.postbox_inner {padding: 10px;}
	.button-primary{margin-top: 10px;}
	.postbox_inner{padding: 10px;}
	.postbox_inner a {text-decoration:none;}
	</style>
<?php
if(isset($_GET['delete_ID']))
	{
	$delete_ID = $_GET['delete_ID'];
	wp_delete_post($delete_ID);
	}
	
if(isset($_GET['edit_ID']))
	{
	include 'BSS_products_edit.php';
	}
	else
	{
	echo '<div class="wrap"><h2>Edit a product</h2><div class="postbox">';
	echo '<h3>Product</h3>';
	echo '<div class="postbox_inner">';
	echo $BSS_product_category;
	$displaymainnews = new WP_Query();
	$displaymainnews->query('category_name="'.$BSS_product_category.'"');
	while ($displaymainnews->have_posts()) : $displaymainnews->the_post();
	$product 		= get_the_title($post->ID);
	$product_id 	= get_the_id($post->ID); 
	$product_desc	= get_the_excerpt($post->ID);
	echo '<a href="?page=sub-page3&amp;delete_ID='.$product_id.'"><input type="button" name="cmd_option_delete" value="Delete" class="button-primary" /></a>
	 <a href="?page=sub-page3&amp;edit_ID='.$product_id.'"><input type="button"  value="Edit" class="button-primary" /></a> '.$product.' '.$product_desc;
	echo '<p>';
	endwhile;			
	echo '</div></div></div>';
	}
?>