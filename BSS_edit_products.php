<div class="wrap">	
	<h2>Current products</h2>
	<?php
	echo $BSS_product_category;
			$displaymainnews = new WP_Query();
			$displaymainnews->query('category_name="'.$BSS_product_category.'"&order=DESC');
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
			}
			echo '</table>';		
			endwhile;
	?>
</div>