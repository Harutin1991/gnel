<!DOCTYPE html>
<html dir="ltr" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="UTF-8">

    </head>
	<body>
			<div id="container" style="margin:20px;">

				<header style="color: #205e75; font-size:26px;">
				                        <div id="logo" style="float:left;">
                            <a href="<?php echo site_url(); ?>">
                                <img style="width:150px; margin-right:30px;" src="<?php echo base_url('themes/babybuy/image/babybuy_logo.png'); ?>" title="babybuy" alt="logo">
                            </a>
                        </div>
						<div  style="float:left; font-size:26px; line-height: auto; margin-top:25px;">
							Մանկական օնլայն խանութ<center style="margin-top:22px;"><a href="<?php echo site_url(); ?>">babybuy.am</a></center>
						</div>
				</header>
				<div style="clear:both;"></div>
                    <br/>
					<br/>
					<br/>
                    <h2><?php echo $this->lang->line('Dear'); ?> <?php echo isset($_POST['first_name']) ? $_POST['first_name'] . ' ' . $_POST['last_name'] : $this->lang->line('customer'); ?>, <?php echo $this->lang->line('Your order is:'); ?></h2>
                    <br/>
					<br/>
	
					<div class="checkout-product">
                        <table style="width: 100%; border-collapse: collapse; border-top: 1px solid #DDDDDD; border-left: 1px solid #DDDDDD;border-right: 1px solid #DDDDDD;margin-bottom: 20px;">
                            <thead>
                                <tr>
                                    <td style="color: #4D4D4D; font-weight: bold; background-color: #F7F7F7; border-bottom: 1px solid #DDDDDD;"></td>
                                    <td style="min-width: 80px; min-height: 60px; text-align: center; color: #4D4D4D; font-weight: bold; background-color: #F7F7F7; border-bottom: 1px solid #DDDDDD;"><?php echo $this->lang->line('Image'); ?></td>
                                    <td style="min-width: 400px; color: #4D4D4D; font-weight: bold; background-color: #F7F7F7; border-bottom: 1px solid #DDDDDD;"><?php echo $this->lang->line('Product Name'); ?></td>
                                    <td style="color: #4D4D4D; font-weight: bold; background-color: #F7F7F7; border-bottom: 1px solid #DDDDDD;"><?php echo $this->lang->line('Code'); ?></td>
                                    <td style="width:100px; text-align:center; color: #4D4D4D; font-weight: bold; background-color: #F7F7F7; border-bottom: 1px solid #DDDDDD;"><?php echo $this->lang->line('Quantity'); ?></td>
                                    <td style="width:100px; color: #4D4D4D; font-weight: bold; background-color: #F7F7F7; border-bottom: 1px solid #DDDDDD;"><?php echo $this->lang->line('Price'); ?></td>
                                    <td style="color: #4D4D4D; font-weight: bold; background-color: #F7F7F7; border-bottom: 1px solid #DDDDDD;"><?php echo $this->lang->line('Total'); ?></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $cart['total'] = 0;
                                $cart['quantity'] = 0;
                                $i = 1;
                                foreach ($shopping_cart AS $product) {
                                    $subtotal = intval($product->quantity * $product->total_amount/$product->quantity);
                                    $cart['total'] += $subtotal;
                                    $cart['quantity'] += intval($product->quantity);
                                    $product_url = product_url($product->id, $product->name);
                                    $image_url = prodImg($product->id, $product->image);
//                                    $thumb_url = thumbImg($image_url, 50, 50);
                                    ?>
                                    <tr>
                                        <td style="border-bottom: 1px solid #DDDDDD;text-align:center;"><?php echo $i++; ?>.</td>
                                        <td style="width:100px;text-align: center; height: 60px;border-bottom: 1px solid #DDDDDD;"><img style="height: 50px; width:50px;"style="display: inline;" src="<?php echo $image_url; ?>" alt="<?php echo $product->name; ?>" title="<?php echo $product->name; ?>"/></td>
                                        <td style="border-bottom: 1px solid #DDDDDD;" ><a style="color:#000;" href="<?php echo $product_url ?>"><?php echo $product->name . ' (' . $product->brand_name . ')'; ?></a></td>
                                        <td style="border-bottom: 1px solid #DDDDDD;" ><?php echo $product->code; ?></td>
                                        <td style="text-align:center; border-bottom: 1px solid #DDDDDD;"><?php echo $product->quantity; ?></td>
                                        <td style="text-align:center; border-bottom: 1px solid #DDDDDD;" class="price"><?php echo (int)$product->total_amount/(int)$product->quantity . ' ' . $this->lang->line('AMD'); ?></td>
                                        <td style="border-bottom: 1px solid #DDDDDD;" ><?php echo $subtotal . ' ' . $this->lang->line('AMD'); ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                            <?php $cart['delivery'] = $delivery_price > 0 ? $delivery_price : ($cart['total'] >= $static_delivery_price ? 0 : $min_delivery_price); ?>
                            <tfoot>
                                <tr>
                                    <td colspan="6" style="padding-right:25px; text-align: right;border-bottom: 1px solid #DDDDDD; height:30px;"><b><?php echo $this->lang->line('Total:'); ?></b></td>
                                    <td style="text-align:left;border-bottom: 1px solid #DDDDDD;"><?php echo $cart['total'] . ' ' . $this->lang->line('AMD'); ?></td>
                                </tr>
                                <tr>
                                    <td colspan="6" style="padding-right:25px; text-align: right;border-bottom: 1px solid #DDDDDD; height:30px;"><b><?php echo $this->lang->line('Delivery:'); ?></b></td>
                                    <td style="text-align:left;border-bottom: 1px solid #DDDDDD;"><?php echo $cart['delivery'] . ' ' . $this->lang->line('AMD'); ?></td>
                                </tr>
                                <tr>
                                    <td colspan="6" style="padding-right:25px; text-align: right;border-bottom: 1px solid #DDDDDD; height:30px;"><b><?php echo $this->lang->line('Points:'); ?></b></td>
                                    <td style="text-align:left;border-bottom: 1px solid #DDDDDD;"><?php echo $order_points . ' ' . $this->lang->line('AMD'); ?></td>
                                </tr>
                                <tr>
                                    <td colspan="6" style="padding-right:25px; text-align: right;border-bottom: 1px solid #DDDDDD; height:30px;"><b><?php echo $this->lang->line('Total:'); ?></b></td>
                                    <td style="text-align: left;border-bottom: 1px solid #DDDDDD;"><?php echo ($cart['total'] + $cart['delivery'] - $order_points) . ' ' . $this->lang->line('AMD'); ?></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div style="clear: both"></div>

			<br/>
			<br/>
			<footer style="color:#205e75; text-align:right;">
			<div style="text-align:right; font-size:18px; padding-right:30px; line-height:1.25;">
              +374 - 93 665 305<br>
              +374 - 99 665 305<br>
              <a style="color:#205e75;" href="mailto:babybuy.am@gmail.com" title="Mail">babybuy.am@gmail.com</a>
			  
            </div>
			</footer>
            </div>
        </div>
    </body>
</html>
