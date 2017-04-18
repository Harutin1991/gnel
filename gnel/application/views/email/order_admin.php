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
							
						</div>
				</header>
				
            </div>
			
			
    <div class="information_content">
        <table class="list">
            <thead>
                <tr>
                    <td class="left" colspan="2" ><h3><?php echo $this->lang->line('Order Details'); ?></h3></td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="left" style="width: 50%;">
					<b><?php echo $this->lang->line('Order ID'); ?> </b>:  #<?php echo $order_id; ?><br/>
                        <?php $date = date_create($current_order[0]->date_created); ?> 
                        <b><?php echo $this->lang->line('Date Added'); ?></b>:  <?php echo date_format($date, 'd/m/Y'); ?></td>
                    
                </tr>
				<tr>
				<td class="left" style="width: 50%;"><b><?php echo $this->lang->line('Payment Method:'); ?></b> <?php echo $this->lang->line('Cash On Delivery'); ?><br>
				</tr>
            </tbody>
        </table>

        <table class="list">

                <tr>
                    <td class="left"><b><?php echo $this->lang->line('Payer'); ?><b>: </td>
                    
					<td class="left"><?php echo $current_order[0]->first_name . ' ' . $current_order[0]->last_name; ?></td>
                </tr>

                <tr>
                    <td class="left" style="vertical-align: top;"><b><?php echo $this->lang->line('Shipping Address'); ?><b>: </td>
                    <td class="left"><?php echo $current_order[0]->ship_first_name . ' ' . $current_order[0]->ship_last_name; ?><br>
                        <?php echo $current_order[0]->ship_address; ?><br>
                        <?php echo $current_order[0]->email; ?><br>
                        <?php echo $current_order[0]->ship_phone; ?><br>
                        <?php echo $current_order[0]->city_name; ?><br>
                        <?php echo $current_order[0]->country_name; ?></td>
                </tr>

        </table>
		<div style="clear:both;"></div>
                    <br/>
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
                                        <td style="border-bottom: 1px solid #DDDDDD;" ><?php echo $product->total_amount/$product->quantity; ?></td>
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

				

		<?php if(isset($current_order[0]->comment) && $current_order[0]->comment != '') { ?>
			<table class="list">
				<thead>
					<tr>
						<td class="left"><?php echo $this->lang->line('Additional information'); ?></td>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td class="left"><?php echo $current_order[0]->comment; ?></td>
					</tr>
				</tbody>
			</table>
		<?php } ?>
    </div>
			
			
			
			
			
			
        </div>
    </body>
</html>
