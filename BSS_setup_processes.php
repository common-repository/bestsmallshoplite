<?php
if(isset($_POST['cmd_BSS_page']))
	{
	$BSS_post_date 		= date("Y-m-d H:i:s");
	$BSS_post_date_gmt 	= gmdate("Y-m-d H:i:s");
	$fld_page_name 		= $_POST['fld_page_name'];
	$fld_category_name 	= $_POST['fld_category_name'];
	$page_title 		= $_POST['fld_page_name'];
	$page_tag 			= $_POST['fld_page_name'];
	$page_option		= $_POST['fld_page_name'];
	
	if($wp_version >= 2.1){$pagepublish='publish';}else{$pagepublish='static';}
	
	$ptable=$wpdb->prefix . "posts";
	$check_page = $wpdb->get_row("SELECT * FROM $qtable WHERE post_type='page' && post_content LIKE '%".$page_tag."%' LIMIT 1");
		if($check_page == null)
		{
		$sql ="INSERT INTO $ptable 
		(post_author, post_date, post_date_gmt, post_content, post_content_filtered, post_title, post_excerpt,  post_status, comment_status, ping_status, post_password, post_name, to_ping, pinged, post_modified, post_modified_gmt, post_parent, menu_order, post_type) 
		VALUES 
		('1', '$BSS_post_date', '$BSS_post_date_gmt', '[product_display]', '', '".$page_title."', '', '".$pagepublish."', 'closed', 'closed', '', '".$fld_page_name ."', '', '', '$BSS_post_date', '$BSS_post_date_gmt', '0', '0', 'page')";
		$wpdb->query($sql);
		$row = $wpdb->get_row("SELECT * FROM $ptable WHERE post_type='page' && post_name='$page_title'");
			
			if($row)
			{
			update_option ('BSS_page_id',$row->ID);
			update_option ('BSS_page_name',$row->post_title);
			}	
			
		$slug = strtolower(str_replace(' ','',$fld_category_name));
		
		$ctable=$wpdb->prefix . "terms";
		$sqlc ="INSERT INTO $ctable (name,slug) VALUES ('$fld_category_name','$slug')";
		$wpdb->query($sqlc);
		
		$rowc = $wpdb->get_row("SELECT * FROM $ctable WHERE slug='$slug'");
			if($rowc)
			{
			$cat_id = $rowc->term_id;
			$ttable=$wpdb->prefix . "term_taxonomy";
			$sqlt ="INSERT INTO $ttable (term_id,taxonomy) VALUES ('$cat_id','category')";
			$wpdb->query($sqlt);
			update_option ('BSS_product_category_id',$cat_id);
			update_option ('BSS_product_category_name',$rowc->name);
			}	
		}
	}
?>