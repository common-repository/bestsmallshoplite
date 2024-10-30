<?php
if ('BestSmallShop.php' == basename($_SERVER['SCRIPT_FILENAME']))

     die ('<h2>'.__('Direct File Access Prohibited','BestSmallShop').'</h2>');

define('BestSmallShop_VERSION', '1.0.1');

/*
Plugin Name: 	BestSmallShopLite
Plugin URI: 	http://www.parotkefalonia.com
Description: 	BestSmallShop
Author: 		Russell Parrott
Author URI: 	http://www.parotkefalonia.com

    Copyright 2009 Russell Parrott (email : russell@parotkefalonia.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

// SET THE STYLE SHEET

// LOAD THE INCLUDES AND SET THE PLUGING PATH

load_plugin_textdomain('BestSmallShopLite', PLUGINDIR . '/' . plugin_basename(dirname(__FILE__)));
/* Add our function to the widgets_init hook. */



// Hook for adding admin menus
	add_action('admin_menu', 'BSS_add_pages');
// Hook for adding TinyMce
	add_filter('admin_head','ShowTinyMCE');


$BSS_page_id 				= get_option('BSS_page_id');
$BSS_page_name				= get_option('BSS_page_name');
$BSS_product_category_id 	= get_option('BSS_product_category_id');
$BSS_product_category_name 	= get_option('BSS_product_category_name');

require_once(ABSPATH . 'wp-load.php');
require_once(ABSPATH . 'wp-admin/includes/taxonomy.php');
require_once(ABSPATH . 'wp-includes/wp-db.php');
global $wp_version;
global $wpdb, $blog_id;
global $BSS_product_category_id;
global $BSS_page_id;
global $BSS_product_category_name;



function ShowTinyMCE() {
	// conditions here
	wp_enqueue_script( 'common' );
	wp_enqueue_script( 'jquery-color' );
	wp_print_scripts('editor');
	if (function_exists('add_thickbox')) add_thickbox();
	wp_print_scripts('media-upload');
	if (function_exists('wp_tiny_mce')) wp_tiny_mce();
	wp_admin_css();
	wp_enqueue_script('utils');
	do_action("admin_print_styles-post-php");
	do_action('admin_print_styles');
}



if ( !get_option('BSS_setup'))
	{
function BSS_add_pages() {
	add_menu_page('BestSmallShop', 'BestSmallShop', 8, __FILE__, 'BSS_setup_page');
	add_submenu_page(__FILE__, 'Settings', 'Set up', 8, 'sub-page', 'BSS_setup_page');
	add_submenu_page(__FILE__, 'Products', 'Products Summary', 8, 'sub-page3', 'BSS_setup_page');
	add_submenu_page(__FILE__, 'Products', 'Add Products', 8, 'sub-page3', 'BSS_setup_page');
	add_submenu_page(__FILE__, 'Products', 'Edit Products', 8, 'sub-page4', 'BSS_product_page');	
	add_submenu_page(__FILE__, 'Product variables', 'Product Variables', 8, 'sub-page5', 'BSS_setup_page');
	add_submenu_page(__FILE__, 'Payment gateways', 'Payment gateways', 8, 'sub-page6', 'BSS_setup_page');
	add_submenu_page(__FILE__, 'Sales', 'Sales', 8, 'sub-page7', 'BSS_setup_page');
	}
}
	
if (get_option('BSS_setup')=='yes')
{
function BSS_add_pages() {
	add_menu_page('BestSmallShop', 'BestSmallShop', 8, __FILE__, 'BSS_about_page');
	add_submenu_page(__FILE__, 'Products', 'Products Summary', 8, 'sub-page1', 'BSS_products');
	add_submenu_page(__FILE__, 'Products', 'Add Products', 8, 'sub-page2', 'BSS_product_page');	
	add_submenu_page(__FILE__, 'Products', 'Edit Products', 8, 'sub-page3', 'BSS_product_edit');	
	add_submenu_page(__FILE__, 'Product variables', 'Product Variables', 8, 'sub-page4', 'BSS_product_variables');
	add_submenu_page(__FILE__, 'Payment gateways', 'Payment gateways', 8, 'sub-page5', 'BSS_payment_gateways');
	add_submenu_page(__FILE__, 'Sales', 'Sales', 8, 'sub-page6', 'BSS_product_sales');
	add_submenu_page(__FILE__, 'Settings', 'Settings', 8, 'sub-page7', 'BSS_settings');
	}
	get_option('BSS_product_category_name');	
	include 'BSS_widget.php';
	}


function BSS_settings(){
	include 'BSS_settings.php';
	}
	
	
function BSS_about_page(){
	include 'BSS_welcome.php';
	}
	
	
	
function BSS_setup_page(){
	global $wpdb, $blog_id, $wp_version, $BSS_product_category_id, $BSS_page_id, $BSS_product_category_name;
	include 'BSS_setup.php';
	}



function BSS_products(){
	global $wpdb, $blog_id, $wp_version, $BSS_product_category_id, $BSS_page_id, $BSS_product_category_name;
	include 'BSS_products.php';
	}



// BSS_product_page() displays BESTSMALLSHOP product info
function BSS_product_page(){
	global $wpdb, $blog_id, $wp_version, $BSS_product_category_id, $BSS_page_id, $BSS_product_category_name;
	include 'BSS_product_add.php';
	}
	
	
	
function BSS_product_edit($edit_ID){
	global $wpdb, $blog_id, $wp_version, $BSS_product_category_id, $BSS_page_id, $BSS_product_category_name;
	include 'BSS_products_select_edit.php';
	}



// BSS_product_page() displays BESTSMALLSHOP product info
function BSS_product_variables(){
	global $wpdb, $blog_id, $wp_version, $BSS_product_category_id, $BSS_page_id, $BSS_product_category_name;
	include 'BSS_product_variables.php';
	}
	
	
	
// BSS_payment_gateways() displays BESTSMALLSHOP payment gateway
function BSS_payment_gateways() {
	global $wpdb, $blog_id, $wp_version, $BSS_product_category_id, $BSS_page_id, $BSS_product_category_name;
	include 'BSS_payment_gateways.php';
	}
	


// BSS_about_page() displays BESTSMALLSHOP about info
function BSS_product_sales() {
	global $wpdb, $blog_id, $wp_version, $BSS_product_category_id, $BSS_page_id, $BSS_product_category_name;
    echo '<h2>Product Sales</h2>';
	echo '<table>';
		echo '<tr>';
		echo '<th>Date</th>';
		echo '<th>Order No</th>';
		echo '<th>Name</th>';
		echo '<th>E-mail</th>';
		echo '<th>Value</th>';
		echo '</tr>';
		
		
	echo get_option('BSS_sales');
	echo '</table>';
	}
	


// BSS_exclude_category excludes the product feed from main blog feed & home page
function BSS_exclude_category($query){
	$BSS_product_category_id = get_option('BSS_product_category_id');
	if($query->is_home)
	{
	$query->set('cat','-'.$BSS_product_category_id.'');
	}
	return $query;
	}

add_filter('pre_get_posts','BSS_exclude_category');
	
	

function start_session()
{
if(!session_id) {session_start();}

session_register("BSS");
if(empty($_SESSION['BSS']))
{
$_SESSION['BSS'] = md5(microtime().$_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']);
$_SESSION['BSS_BASKET'] 	= array();
$_SESSION['BSS_TOTAL']		= array();
$_SESSION['BSS_PRODUCT']	= array();
$_SESSION['BSS_QUANTITY']	= array();
}
else {
$_SESSION['BSS']			= $_SESSION['BSS'];
$_SESSION['BSS_BASKET'] 	= $_SESSION['BSS_BASKET'];
$_SESSION['BSS_PRODUCT']	= $_SESSION['BSS_PRODUCT'];
$_SESSION['BSS_TOTAL']		= $_SESSION['BSS_TOTAL'];
$_SESSION['BSS_QUANTITY']	= $_SESSION['BSS_QUANTITY'];
}
}
add_action('init','start_session');

function product_display() {
	if(isset($_GET['checkout_go'])) {
	include_once('checkout.php');
	}
	else {
	
	$slug = strtolower(str_replace(' ','',get_option('BSS_product_category_name')));
	$showposts = -1; // -1 shows all posts
	$do_not_show_stickies = 1; // 0 to show stickies
	$args=array(
	   'category_name' => $slug,
	   'showposts' => $showposts,
	   'caller_get_posts' => $do_not_show_stickies
	   );
	 ?> 
	 <div class="search">
		<?php get_search_form(); ?>
	 </div>
	<?php 	
	$my_query = new WP_Query($args); 
	if( $my_query->have_posts() ) :  while ($my_query->have_posts()) : $my_query->the_post(); 
			//necessary to show the tags 
			global $wp_query;
			$wp_query->in_the_loop = true;
			ob_start();
			the_title();
			$thetitle = ob_get_contents();
			ob_end_clean();
			ob_start();
			the_permalink();
			$the_permalink = ob_get_contents();
			ob_end_clean();
			ob_start();
			the_title_attribute();
			$the_title_attribute = ob_get_contents();
			ob_end_clean();
			ob_start();
			the_excerpt('Read the full post',true);
			$postOutput = preg_replace('/<img[^>]+./','',ob_get_contents());
			ob_end_clean();
			?>
			<div class="BSS_shop">
			<h2><a href="<?php echo $the_permalink; ?>" rel="bookmark" title="Permanent Link to <?php echo $the_title_attribute; ?>"><?php echo $thetitle; ?></a></h2>
			<?php
			$product_options = get_post_custom_values('Product Options');
			$option_headers = get_option(BSS_admin_product_options);
			$option_titles = explode('^',$option_headers);
			?>
			<?php get_first_image(); ?>
			<?php echo $postOutput; ?>
			<div class="BSS_clear_left"></div>
			<table cellspacing="0">
			<tr>
			<?php
			for($t=0; $t<=count($option_titles); $t++)
			{
			if($option_titles[$t]=="stock"){}
			elseif($option_titles[$t]=="product_code"){}
			elseif($option_titles[$t]=="price") {echo '<th align="right">'.ucfirst(str_replace('_',' ',($option_titles[$t]))).' <em><small>'.get_option('BSS_default_currency').'</small></em></th>';}
			else {echo '<th>'.ucfirst(str_replace('_',' ',($option_titles[$t]))).'</th>';}
			}
			?>
			<th>Quantity</th>
			<th>Select &amp; add</th>
			</tr>
			<?php
			if(empty($product_options)){}
			else{foreach ($product_options as $key => $value) {
			?>
			<tr>
			<form method="post" action="">
			<?php
			$val_split 		= explode('^',$value);
			$stock 			= count($val_split)-1;
			$price 			= count($val_split)-2;
			$product_code 	= count($val_split)-3;
			$product 		= $val_split[$product_code];
			for($v = 0; $v<=count($val_split); $v++)
				{
				if($v == $stock){}
				elseif($val_split[$stock]=='0'){}
				elseif($v == $product_code){}				
				elseif($v == $price){echo '<td align="right">'.number_format($val_split[$v],2).'</td>';}
				else { echo '<td>'.ucfirst($val_split[$v]).'</td>'; }
				}
			?>
			<input type="hidden" name="price" value="<?php echo $val_split[$price]; ?>">
			<input type="hidden" name="product_name" value="<?php echo $thetitle; ?>">
			<td align="center">
			<select name="quantity">
			<?php
			for($z=1; $z<=20; $z++)
				{
				echo '<option value="'.$z.'">'.$z.'</option>';
				}
			?>	
			</select>
			<?php
			if((isset($_GET['basket']))||(isset($_GET['delete']))) {}
			else {
			?>
			<td align="center">
			<input type="checkbox" name="product" value="'.$value.'" />
			<input type="submit" name="cmd_add" value="Add" />
			</td>
			<?php } ?>
			</form>
			</tr>
			<?php 	}} ?>
			</table>			
			<div class="BSS_reviews">
			<?php the_tags('Tags: ', ', ', '<br />'); ?> <?php comments_popup_link('No reviews', '1 Review', '% Reviews'); ?>
			</div>
			</div>	
		<?php	
		endwhile;
		else : 
		?>
		<h2 class="center">Not Found</h2>
		<p class="center">Sorry, but you are looking for something that isn't here.</p>
		<?php
		get_search_form();
		endif; 
	}
	}
	add_shortcode('product_display','product_display');
	
	
function get_first_image() {
global $post, $posts;
$first_img = '';
ob_start();
ob_end_clean();
$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
$first_img = $matches [1] [0];

if(empty($first_img)){ //Defines a default image
$first_img = "/images/default.jpg";
}
return $first_img;
}


function BSS_style() {
echo '<link rel="stylesheet" href="'.get_bloginfo('wpurl').'/wp-content/plugins/bestsmallshoplite/BSS_css/BSS_layout.css" type="text/css" media="screen" />';
}
add_action('wp_head','BSS_style');


function BSS_power() {
echo get_option('blogname').' online shop incorporated into '.get_option('blogname').' by the <a href="http://parotkefalonia.com/blog/2009/08/31/bestsmallshoplite-the-e-commerce-and-shopping-cart-plugin-for-wordpress/">BestSmallShopLite</a> Wordpress plugin';
}
add_action ('wp_footer','BSS_power');


function BSS_admin_css() {
echo '<link rel="stylesheet" href="'.get_bloginfo('wpurl').'/wp-content/plugins/bestsmallshoplite/BSS_css/BSS_admin_layout.css" type="text/css" media="screen" />';
}
add_action('admin_head','BSS_admin_css');
?>