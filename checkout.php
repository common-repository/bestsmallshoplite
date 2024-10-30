<?php
if(isset($_GET['checkout_go']))
{
if(isset($_POST['cmd_confirm']))
{
?>
<strong><?php echo $_POST['first_name']; ?>, thank you for the information this means your order can now be processed.</strong>
<p>We hope you enjoyed shopping on-line at <?php echo get_option('blogname'); ?> and that you will return in the future.</p>
<p>We have just sent you an e-mail to <?php echo $_POST['email']; ?> confirming your order.  If you have any questions please contact us a quote your order reference <strong><?php echo substr($_SESSION['BSS'],0,10); ?>.</strong>
<p>Before you checkout why not book mark <?php echo get_option('blogname'); ?> for your future reference and don't forget to tell all your relations and friends about us.</p>
<?php 




$total 		= $_POST['fld_total']; 

$fld_reference 			= $_POST['fld_reference']; 
$first_name 			= $_POST['first_name']; 
$last_name 				= $_POST['last_name']; 
$address1 				= $_POST['address1']; 
$address2 				= $_POST['address2']; 
$city					= $_POST['city']; 
$state 					= $_POST['state']; 
$zip 					= $_POST['zip']; 
$email 					= $_POST['email']; 
$day_phone_a 			= $_POST['day_phone_a']; 
$fld_delivery_address	= $_POST['fld_delivery address']; 

$BSS_sales 		= get_option('BSS_sales');
$NEW_BSS_sales 	= '<tr><td>'.date('d m Y').'</td><td>'.substr($_SESSION['BSS'],0,10).'</td><td>'.$first_name.' '.$last_name.'</td><td>'.$email.'</td><td>'.number_format(array_sum($_SESSION['BSS_TOTAL']),2).'</td></tr>'.$BSS_sales;
update_option('BSS_sales',$NEW_BSS_sales);

$subject = "Your purchase confirmation from ".get_option('blogname');
$Enquiry = "Hello ".$first_name.",";
$Enquiry.= "\n\nThank you for your order.";
$Enquiry.= "<strong>Your order reference is ".$fld_reference."</strong>";
$Enquiry.= "\n\n".get_option('BSS_shop_email');
$basket2 = $_SESSION['BSS_BASKET'];
$x=1;
foreach ($basket2 as $key =>$val)
{
$Enquiry.= "\n ".$_SESSION['BSS_PRODUCT'][$key]." (quanity  ".$_SESSION['BSS_QUANTITY'][$key].") ".number_format($_SESSION['BSS_TOTAL'][$key],2);	
}
$Enquiry.= "\n\nYour order will be delivered to";
$Enquiry.= "\n ".$address1;
$Enquiry.= "\n ".$address2;
$Enquiry.= "\n ".$city;
$Enquiry.= "\n ".$state;
$Enquiry.= "\n ".$zip;

$Enquiry.= "\n\nWe hope you enjoyed shopping on-line at ".get_option('blogname')." and that you will return in the future.";
$Enquiry.= "\n ".get_option('BSS_shop_name');
$Enquiry.= "\n ".get_option('BSS_contact_person');
$Enquiry.= "\n ".get_option('BSS_address');
$Enquiry.= "\n ".get_option('BSS_contact_email');
	
if(get_option('BSS_registration_number')=="-"){}
else { $Enquiry.= "\n Registration number: ".get_option('BSS_registration_number');}
if(get_option('BSS_vat_number')=="-"){}
else { $Enquiry.= "\nSales Tax number: ".get_option('BSS_vat_number');}
		
$headers = "From: ".get_option('blogname')."\r\n";
$headers .= "X-Sender: ".get_option('siteurl')."\r\n";
$headers .= "X-Mailer: php\r\n"; // mailer
$headers .= "X-Priority: 1\r\n"; // Urgent message!
$headers .= "Return-Path: $returnpath\r\n"; // Return path for errors 
$headers .= "Cc:".get_option('BSS_shop_email')."\r\n"; // Return path for errors 

mail ($email, $subject, $Enquiry, $headers); 
mail (get_option('BSS_shop_email'), $subject, $Enquiry, $headers); 
?>				
</p>
<form action="https://www.paypal.com/uk/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_cart">
<input type="hidden" name="business" value="<?php echo get_option('BSS_gateway_email'); ?>">
<?php
$basket2 = $_SESSION['BSS_BASKET'];
$x=1;
foreach ($basket2 as $key =>$val)
{
echo '<input type="hidden" name="upload" value="'.$x.'">';
echo '<input type="hidden" name="item_name_'.$x.'" value="'.$_SESSION['BSS_PRODUCT'][$key].' (quanity  '.$_SESSION['BSS_QUANTITY'][$key].')">';	
echo '<input type="hidden" name="amount_'.$x.'" value="'.number_format($_SESSION['BSS_TOTAL'][$key],2).'">';	
$x++;
}
?>
<input type="hidden" name="currency_code" value="<?php echo get_option('BSS_default_currency'); ?>">
<input type="hidden" name="no_shipping" value="0">
<input type="hidden" name="amount" value="<?php  echo number_format(array_sum($_SESSION['BSS_TOTAL']),2); ?>">
<input type="image" src="http://www.paypal.com/en_GB/i/btn/x-click-but01.gif" name="submit" alt="Make payments with PayPal - it's fast, free and secure!">
</form>
<?php 
session_destroy();
}
else
{
?>

<form method="post" action="" style="text-align: left; margin-top: 20px;">
<table>
<tr>
<td>Order reference</td><td><?php echo substr($_SESSION['BSS'],0,10); ?><input type="hidden" name="fld_reference" value="<?php echo substr($_SESSION['BSS'],0,10); ?>" ></td>
</tr><tr>
<td>Your first name (given name)</td><td><input type="text" name="first_name" ></td>
</tr><tr>
<td>Your last name (surname)</td><td><input type="text"  name="last_name"></td>
</tr><tr>
<td>Your address</td><td><input type="text"  name="address1"></td>
</tr><tr>
<td> </td><td><input type="text"  name="address2"></td>
</tr><tr>
<td>Town / City</td><td><input type="text"  name="city"></td>
</tr><tr>
<td>State</td><td><input type="text"  name="state"></td>
</tr><tr>
<td>Postcode / Zip </td><td><input type="text"  name="zip"></td>
</tr><tr>
<td>Your e-mail address</td><td><input type="text"  name="email" ></td>
</tr><tr>
<td>Telephone number</td><td><input type="text"  name="day_phone_a"></td>
</tr><tr>
<td>Delivery address<br /><small>(if different from address)</small></td><td><textarea  name="fld_delivery_address"></textarea></td>
</tr><tr>
<td></td><td><input type="submit" value="Confirm delivery details" name="cmd_confirm"/></td>
</tr>
</table>
</form>
Note: All items will be dispatched in accordance with our terms and conditions
<?php   } }?>