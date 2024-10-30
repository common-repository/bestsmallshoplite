	<style>
	h3 { margin: 0px; padding: 10px;}
	.postbox_inner {padding: 10px;}
	.button-primary{margin-top: 10px;}
	</style>
<div class="wrap">	
	<h2>Edit a product</h2>
	<a href="admin.php?page=sub-page3">Product list</a>
	<p>
	<?php
	echo $BSS_product_category;
	
	$edit_ID = $_GET['edit_ID'];
	
	query_posts('p='.$edit_ID.'');
	if(have_posts()) : while ( have_posts()) :  the_post();
		$product_id 					= get_the_id($edit_ID);
		
		if(!isset($_POST['BSS_product_update']))
		{
		$product 		     	= get_the_title($edit_ID);
		$product_description 	= get_the_content($edit_ID);
		}
		
		if(isset($_POST['BSS_product_update']))
		{
		$my_post 		= array();
		$my_post['ID'] 	= $edit_ID;
		$my_post['post_content'] = $_POST['content'];
		$my_post['page_name']    = $_POST['page_name'];
		
		wp_update_post($my_post);
		if(wp_update_post)
			{
			$product 		     	= get_the_title($edit_ID);
			$product_description 	= get_the_content($edit_ID);
			}		
		}
		if(isset($_POST['BSS_add_option']))
		{
		foreach($_POST as $key=>$val)
				{
				if($key=="BSS_add_option"){}
				else{$input[] = $val;}
				}
		$update_data = implode('^',$input);
		add_post_meta($edit_ID,'Product Options', $update_data);
		if(add_post_meta)
				{
				$product_options 		= get_post_custom_values('Product Options');
				}
		}
		
		if(isset($_POST['cmd_option_update']))
			{
			$meta_id 	= $_POST['meta_id'];
			$old_data	 = $_POST['old_data'];
			foreach($_POST as $key=>$val)
				{
				if($key=="cmd_option_update"){}
				elseif($key=="meta_id"){}
				elseif($key=="old_data"){}
				else{$input[] = $val;}
				}
			$update_data = implode('^',$input);
			update_post_meta($edit_ID,'Product Options', $update_data, $old_data);
			if(update_post_meta)
				{
				$product_options 		= get_post_custom_values('Product Options');
				}
			}
			
		if(isset($_POST['cmd_option_delete']))
			{
			$meta_id 	= $_POST['meta_id'];
			$old_data	 = $_POST['old_data'];
			
			delete_post_meta($edit_ID,'Product Options', $old_data);
			if(delete_post_meta)
				{
				$product_options 		= get_post_custom_values('Product Options');
				}
			}
		
		if(!isset($_POST['cmd_option_update']))
		{
		$product_options 		= get_post_custom_values('Product Options');
		}
		
		
	?>		
			
	<div class="postbox"> 
	<form method="post" action="" style="padding: 10px; font-size: 1.1em; line-height: 1.3;">
	Product name
	<input type="text" name="page_name" value="<?php echo $product; ?>"style="width: 100%; padding: 10px; font-size: 1.3em;" />
	<br />
	Product description
	<?php 
		the_editor($product_description); 
	?>
	<br />
	<input type="submit" name="BSS_product_update" value="Update product" class="button-primary" />
	</form>
	</div>
	<div class="postbox">
	<h3>Product options</h3>
	<?php		
			$option_headers = get_option(BSS_admin_product_options);
			$option_titles = explode('^',$option_headers);
			echo '<table cellspacing="5">';
				echo '<tr>';
					echo '<th>Option</th>';
					
					for($t=0; $t<=count($option_titles); $t++)
						{
						echo '<th>'.ucfirst($option_titles[$t]).'</th>';
						}
			echo '</tr>';	
			
				if(empty($product_options)){}
				else{foreach ($product_options as $key => $value) 
				{
				
				echo '<form method="post" action="" style="padding: 10px; font-size: 1.1em; line-height: 1.3;">';
				
				echo '<td><input type="hidden" name="old_data" value="'.$value.'" /></td>';
				
				echo '<tr><td>Option '.($key+1).'</td>';
				$val_split = explode('^',$value);
				for($v=0; $v<=count($val_split)-1; $v++)
					{
					echo '<td><input type="text" name="'.$option_titles[$v].'" value="'.ucfirst($val_split[$v]).'" size="10"/></td>';
					}
				echo '<td><input type="submit" name="cmd_option_update" value="Update" class="button-primary" /></td>';
				echo '<td><input type="submit" name="cmd_option_delete" value="Delete" class="button-primary" /></td>';	
				echo '</tr>';
				echo '</form>';
				
				}
			}
			echo '</table>';		
		endwhile;
		endif;
	?>
	</div>

	<div class="postbox"> 
	<h3>Add product options</h3>
	<form method="post" action="" style="padding: 10px; line-height: 1.3;">
		
	<table cellspacing="5">
				<tr><th>Option</th>
					<?php
					for($t=0; $t<=count($option_titles); $t++)
						{
						echo '<th>'.ucfirst($option_titles[$t]).'</th>';
						}
					?>
			</tr><tr><td>New option</td>
			<?php
			for($v=0; $v<=count($option_titles)-1; $v++)
			{
			echo '<td><input type="text" name="'.$option_titles[$v].'" value=""  size="10"/></td>';
			}
			echo '<td><input type="submit" name="BSS_add_option" value="Add" class="button-primary" /></td>';
			?>
			</tr></table>
	</form>
	</div>
</div>