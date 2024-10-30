<div class="wrap">
<form method="post" action="" >
<?php
$qtable	= $wpdb->prefix . "posts";
$q 	= 	$product_options;
echo '<input type="hidden" name="product_options" value="'.$q.'"/>';
for($q1=1; $q1<=$q; $q1++)
{
echo '<div class="postbox">';
echo '<h3>Product option '.$q1.'</h3>';
echo '<div class="postbox_inner">';
echo '<input type="hidden" name="page_id['.$q1.']" value="'.$page_id.'"/>';
$BSS_admin_product_options = explode('^',get_option('BSS_admin_product_options'));
foreach ( $BSS_admin_product_options as $key => $value )
{

echo ucfirst(str_replace('_',' ',($value))).' <input type="text" name="'.$value.'['.$q1.']" size="10" value="" style="padding: 5px; font-size: 1.3em;" /><br/>';
}
echo '</div></div>';
}
?>	
<input type="submit" name="BSS_product_options" value="Add options"  class="button-primary" />
</form>
</div>