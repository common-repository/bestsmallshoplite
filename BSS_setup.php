<div class="wrap">
<?php
if(isset($_GET['setup']))
{
include 'BSS_setup1.php';

include 'BSS_setup2.php';
}

elseif(isset($_GET['setup1']))
{
include 'BSS_setup3.php';
include 'BSS_setup4.php';
}

elseif(isset($_GET['setup2']))
{
include 'BSS_setup5.php';
}
else
{
?>

<h2>Welcome to Best Small Shop Lite</h2>
<blockquote>
Thank you for activating Best Small Shop Lite a shopping cart plugin for WordPress that accepts online payments through PayPal
<p>Before you start to operate your Best Small Shop Lite wordpress plugin you need to create some default settings.  This does not take long, but you need to do it so your plugin works correctly.</p>
<p>If you feel uncertain about setting up your Best Small Shop Lite plugin then this video clip is useful as it takes you through the whole set up process.</p>
<h3>Part 1 - How your products are displayed</h3>
<ol>
	<li>The page name on which to display your products.  By default your products are not displayed within your blog feed.</li>
	<li>A category name for your products to be grouped and displayed in.</li>
	<li>A list of the variables that your products may have e.g. colour, size, weight etc. - you can always add and edit this later.</li>
</ol>
<h3>Part 2 - Information about how you trade</h3>
<ol>
	<li>Trading name, contact details for your shop etc.  and if appliciable, your company registration number and sales tax/VAT number. Note: if you have either it is a legal requirement they be displayed on an e-commerce site.</li>
	<li>How people will pay you e.g. PayPal, Google Checkout etc. and the currency for your Best Small Shop Lite - you can always add and edit this later.</li>
</ol>
<h3>Part 3 - Some small admin bits</h3>
<ol>
	<li>The content of the e-mail message that will be sent to people when they make a purchase from your shop.</li>
	<li>Your terms and conditions.</li>
</ol>
</blockquote>
<h2>Ready? OK, let's get started</h2>
<a href="?page=bestsmallshoplite/BestSmallShopLite.php&amp;setup=1;"><input typye="button" name="setup" value="Get started" class="BSS_setup_but"/></a>
<?php
}
?>
</div>