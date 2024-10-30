<div class="wrap">
<?php
	if(isset($_POST['BSS_product_options']))
	{
		$product_options = $_POST['product_options'];
		for($q1=1; $q1<=$product_options; $q1++)
			{
			$page_id 	= $_POST['page_id'][$q1];
			$BSS_admin_product_options = explode('^',get_option('BSS_admin_product_options'));
			
				
				foreach ( $BSS_admin_product_options as $key => $value )
				{
				$results .= $_POST[$value][$q1].'^';
				}
				$results .= $page_id;
				}
			
			$test 	= explode('^'.$page_id,$results);
			
			for($in = 0; $in<count($test)-1; $in++)
			{
			
			$qtable=$wpdb->prefix . "postmeta";
			$sql2 ="INSERT INTO $qtable (post_id,meta_key,meta_value) VALUES ('".$page_id."','Product Options','".$test[$in]."')";
			$option_add = $wpdb->query($sql2);
			}
		if($option_add)
			{
			$page_id = $page_id;
			echo '<h2>Product and options sucsessfully added</h2>';
			
			$displaymainnews = new WP_Query();
			$displaymainnews->query('showposts=1&category_name="'.$BSS_product_category.'"&order=DESC');
			while ($displaymainnews->have_posts()) : $displaymainnews->the_post();
			$product 		 = get_the_title($post->ID);
			$product_options = get_post_custom_values('Product Options');
			the_title();
			the_content();
			
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
			echo '<tr><td>Option '.($key+1).'</td>';
			$val_split = explode('^',$value);
			for($v=0; $v<=count($val_split); $v++)
				{
				echo '<td>'.ucfirst($val_split[$v]).'</td>';
				}
			echo '</tr>';
			}
			echo '</table>';	
					
			}
			endwhile;
			}
	}
	else
	{	
	if(isset($_POST['BSS_product_create']))
	{
		
		$product_options = $_POST['product_options'];	
		
		if(is_numeric($product_options))
		{
	
		$post_date 		= date("Y-m-d H:i:s");
		$post_date_gmt 	= gmdate("Y-m-d H:i:s");
		$page_name 		= $_POST['page_name'];
		$page_title 	= $_POST['page_name'];
		$page_tag 		= $_POST['content'];
		
		if($wp_version >= 2.1){$pagepublish='publish';}else{$pagepublish='static';}
		
		$qtable=$wpdb->prefix . "posts";
		$check_page = $wpdb->get_row("SELECT * FROM $qtable WHERE post_type='post' && post_title ='".$page_title."' LIMIT 1");
				if($check_page == null)
				{
				$sql1 ="INSERT INTO $qtable (post_author, post_date, post_date_gmt, post_content, post_content_filtered, post_title, post_excerpt,  post_status, comment_status, ping_status, post_password, post_name, to_ping, pinged, post_modified, post_modified_gmt, post_parent, menu_order, post_type) VALUES ('1', '$post_date', '$post_date_gmt', '".$page_tag."', '', '".$page_title."', '', '".$pagepublish."', 'open', 'open', '', '".$page_name."', '', '', '$post_date', '$post_date_gmt', '$post_parent', '0', 'post')";
					$wpdb->query($sql1);
					$row = $wpdb->get_row("SELECT * FROM $qtable WHERE post_type='post' && post_title ='".$page_title."' LIMIT 1");
						if($row)
						{
						$page_id = $row->ID;
						$catagory_id = get_option('BSS_product_category_id');
						
						
						$tttable =$wpdb->prefix . "term_taxonomy";
						$rowtt 	 = $wpdb->get_row("SELECT * FROM $tttable WHERE term_id ='$catagory_id' LIMIT 1");
						
						$term_taxonomy_id = $rowtt->term_taxonomy_id;
						
						$qtable2=$wpdb->prefix . "term_relationships";
						$sql2 ="INSERT INTO $qtable2 (term_taxonomy_id,object_id) VALUES ('$term_taxonomy_id','$page_id')";
						$wpdb->query($sql2);
						echo  '<h2>'.$row->post_title.'</h2>';
						echo  $row->post_content;
						include 'BSS_product_options_add.php';
						}
						else
						{
						}
				}
			
		}	
		else
		{
		echo '<h2>You entered a non-numeric value in the "Number of product options (e.g colours, sizes etc.)" field.  Please enter a number</h2>';
		}
		
	}
	else
	{
?>
	<h2>Add a product</h2>
	<div class="postbox"> 
	<form method="post" action="" style="padding: 10px; font-size: 1.1em; line-height: 1.3;">
	Product name
	<input type="text" name="page_name" style="width: 100%; padding: 10px; font-size: 1.3em;" />
	<br />
	Product description
	<?php the_editor($content_to_load); ?>
	<br />
	Number of product options (e.g colours, sizes etc.) <input type="text" name="product_options" size="3" style="padding: 10px; font-size: 1.3em;" />
	<input type="submit" name="BSS_product_create" value="Add product" class="button-primary" />
	</form>
<?php 
	} 
	}
?>
</div>