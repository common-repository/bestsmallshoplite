<?php
/**
 * BestSmallShopLite Class
 */
class BestSmallShopLite extends WP_Widget {
    /** constructor */
    function BestSmallShopLite() {
        parent::WP_Widget(false, $name = 'BestSmallShopLite');	
    }
    function widget($args, $instance) {		
        extract( $args );
        ?>
              <?php  echo $before_widget; ?>
               <?php echo $before_title
				. $instance['title']
				. $after_title; 
				$BSS_page_id 			= get_option('BSS_page_id');
				$BSS_default_currency	= explode("|",get_option('BSS_default_currency'));?>
				<h2 style="margin-top: 20px;'"><?php echo  ucfirst(get_option('BSS_page_name')); ?></h2>
                 <ul><li>
					<a href="/?page_id=<?php echo $BSS_page_id; ?>" title="Go to <?php echo ucfirst(get_option('BSS_product_category_name')); ?> our online shop"><?php echo ucfirst(get_option('BSS_product_category_name')); ?></a>
				 </li>
				<?php $recent = new WP_Query(); ?>
				<?php $recent->query('cat='.get_option('BSS_product_category_id').''); ?>
				<ul>
				<?php while($recent->have_posts()) : $recent->the_post(); ?>
						<li>
							<a href="<?php the_permalink(); ?>">
							<?php the_title(); ?>
							</a>
					   </li>
				<?php endwhile; ?>
				</ul>				 
				</ul>				 
					<?php
					$BSS_default_currency_symbol = $BSS_default_currency[1];
					if((isset($_GET['basket']))||(isset($_GET['delete']))) {
					?>
					<h2 style="margin-top: 20px;">Your Basket review</h2>
					<?php
					if(isset($_GET['delete']))
					{
					$keyd = $_GET['delete'];
					unset($_SESSION['BSS_BASKET'][$keyd]);
					unset($_SESSION['BSS_TOTAL'][$keyd]);
					unset($_SESSION['BSS_PRODUCT'][$keyd]);
					unset($_SESSION['BSS_QUANTITY'][$keyd]);
					echo 'Your basket has been updated <a href="?page_id='.$BSS_page_id.'">continue shopping</a><p>';
					}
					?>
					<ul style="margin-bottom: 10px;">
					<?php
					$basket2 = $_SESSION['BSS_BASKET'];
					foreach ($basket2 as $key =>$val)
					{
					echo '<li><a href="?page_id='.$BSS_page_id.'&amp;delete='.$key.'">Delete</a> '.$_SESSION['BSS_QUANTITY'][$key].' x 
					'.$_SESSION['BSS_PRODUCT'][$key].' @ ';
					echo number_format($_SESSION['BSS_TOTAL'][$key],2).'</li>';
					}
					?>
					</ul>
					Your basket total is <?php echo $BSS_default_currency_symbol.''.number_format(array_sum($_SESSION['BSS_TOTAL']),2); ?>
					<ul><li><a href="?page_id=<?php echo $BSS_page_id; ?>">Continue shopping</a></li>
					<li><a href="?page_id=<?php echo $BSS_page_id; ?>&amp;checkout_go=1">Checkout</a></li></ul>
					<?php					
					} 
					else {										
						if(isset($_POST['cmd_add'])) {
						if(empty($_POST['product'])){}
							else {
							$basket1 = $_POST['product'];
							array_push($_SESSION['BSS_BASKET'],$basket1);
							$to_add	 = $_POST['price']*$_POST['quantity'];
							array_push($_SESSION['BSS_TOTAL'],$to_add);
							$product_name = $_POST['product_name'];
							array_push($_SESSION['BSS_PRODUCT'],$product_name);
							$new_qty 	= $_POST['quantity'];						
							array_push($_SESSION['BSS_QUANTITY'],$new_qty);
							}
						}
					}
					if(!$_SESSION['BSS_TOTAL']){}
					elseif((isset($_GET['basket']))||(isset($_GET['delete']))){}
					else{ 
					$basket_count = explode("+",$_SESSION['BSS_BASKET']);
					?>
					<h2 style="margin-top: 20px;">Your Basket</h2>
					
					<ul><li>Your basket total is <?php echo $BSS_default_currency_symbol.''.number_format(array_sum($_SESSION['BSS_TOTAL']),2); ?></li></ul>
					<ul><li><a href="?page_id=<?php echo $BSS_page_id; ?>&amp;basket=1">Review basket</a></li>
					<li><a href="?page_id=<?php echo$BSS_page_id; ?>&amp;checkout_go=1">Checkout</a></li>
					</ul>
					<?php } ?>
			 
              <?php echo $after_widget; ?>
        <?php
    }
    function update($new_instance, $old_instance) {				
        return $new_instance;
    }
    function form($instance) {	
		$BSS_page_name = get_option('BSS_page_name');			
        $title = esc_attr($instance['title']);
        ?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?> 
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
        <?php 
    }
}
 // class BestSmallShopLite

// register BestSmallShopLite widget
add_action('widgets_init', create_function('', 'return register_widget("BestSmallShopLite");'));