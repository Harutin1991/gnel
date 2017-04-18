<div id="content">
    <div class="breadcrumb"> <a href="<?php echo site_url(); ?>"><?php echo $this->lang->line('Home'); ?></a> » <a href="<?php echo site_url('account/'); ?>"><?php echo $this->lang->line('Account'); ?></a> » <a href="<?php echo site_url('account/orderhistory/'); ?>"><?php echo $this->lang->line('Order History'); ?></a> » <?php echo $this->lang->line('Order Information'); ?> </div>
    <h1><span class="h1-top"><?php echo $this->lang->line('Order Information'); ?></span></h1>
    <div class="information_content">
        <table class="list">
            <thead>
                <tr>
                    <td class="left" colspan="2"><?php echo $this->lang->line('Order Details'); ?></td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="left" style="width: 50%;"><b><?php echo $this->lang->line('Order ID'); ?> </b>  #<?php echo $order_id; ?><br>
                        <?php $date = date_create($order[0]->date_created); ?> 
                        <b><?php echo $this->lang->line('Date Added'); ?></b>  <?php echo date_format($date, 'd/m/Y'); ?></td>
                    <td class="left" style="width: 50%;"><b><?php echo $this->lang->line('Payment Method:'); ?></b> <?php echo $this->lang->line('Cash On Delivery'); ?><br>
                </tr>
            </tbody>
        </table>
        <table class="list">
            <thead>
                <tr>
                    <td class="left"><?php echo $this->lang->line('Payer'); ?></td>
                    <td class="left"><?php echo $this->lang->line('Shipping Address'); ?></td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="left"><?php echo $order[0]->first_name . ' ' . $order[0]->last_name; ?><br/>
                    </td>
                    <td class="left"><?php echo $order[0]->ship_first_name . ' ' . $order[0]->ship_last_name; ?><br>
                        <?php echo $order[0]->ship_address; ?><br>
                        <?php echo $order[0]->city_name; ?><br>
                        <?php echo $order[0]->country_name; ?></td>
                </tr>
            </tbody>
        </table>
        <table class="list order-products-info">
            <thead>
                <tr>
                    <td class="left"><?php echo $this->lang->line('Image'); ?></td>
                    <td class="left"><?php echo $this->lang->line('Product Name'); ?></td>
                    <td class="left"><?php echo $this->lang->line('Code'); ?></td>
                    <td class="right"><?php echo $this->lang->line('Quantity'); ?></td>
                    <td class="right"><?php echo $this->lang->line('Price'); ?></td>
                    <td class="right"><?php echo $this->lang->line('Total'); ?></td>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($order)) { ?>
                    <?php
                    $cart['total'] = 0;
                    $cart['quantity'] = 0;
                    foreach ($order AS $product) {
                        $subtotal = intval($product->product_qty * $product->product_price);
                        $cart['total'] += $subtotal;
                        $cart['quantity'] += intval($product->product_qty);
                        $product_url = product_url($product->product_id, $product->product_name);
                        $img_url = prodImg($product->product_id, $product->image);
                        ?>
                        <tr>
                            <td class="left"><a href="<?php echo $product_url; ?>"><img src="<?php echo thumbImg($img_url, 50, 50); ?>" /></a></td>
                            <td class="left"><a href="<?php echo $product_url; ?>"><?php echo $product->product_name; ?></a></td>
                            <td class="left"><?php echo $product->code; ?></td>
                            <td class="right"><?php echo $product->product_qty; ?></td>
                            <td class="right"><?php echo $product->product_price . ' ' . $this->lang->line('AMD'); ?></td>
                            <td class="right"><?php echo $subtotal . ' ' . $this->lang->line('AMD'); ?></td>
                        </tr>
                    <?php } ?>
                <?php  } else { ?>
                    <tr><td><?php echo $this->lang->line('No products selected in this order'); ?></td></tr>
                <?php } ?>
            </tbody>
            <tfoot>
            <?php $delivery_price = $order[0]->delivery_price == 0 &&  $cart['total'] < $static_delivery_price ? $min_delivery_price : $order[0]->delivery_price; ?>
                <tr>
                    <td colspan="4"></td>
                    <td class="right"><b><?php echo $this->lang->line('Total:'); ?></b></td>
                    <td class="right"><?php echo $cart['total'] . ' ' . $this->lang->line('AMD'); ?></td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                    <td class="right"><b><?php echo $this->lang->line('Delivery:'); ?></b></td>
                    <td class="right"><?php echo $delivery_price . ' ' . $this->lang->line('AMD'); ?></td>
                </tr>
                 <tr>
                    <td colspan="4"></td>
                    <td class="right"><b><?php echo $this->lang->line('Points:'); ?></b></td>
                    <td class="right"><?php echo abs($order_points) . ' ' . $this->lang->line('AMD'); ?></td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                    <td class="right"><b><?php echo $this->lang->line('Total:'); ?></b></td>
                    <td class="right"><?php echo ($cart['total'] + $delivery_price + $order_points) . ' ' . $this->lang->line('AMD'); ?></td>
                </tr>
            </tfoot>
        </table>
        <table class="list">
            <thead>
                <tr>
                    <td class="left"><?php echo $this->lang->line('Additional information'); ?></td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="left"><?php echo $order[0]->comment; ?></td>
                </tr>
            </tbody>
        </table>
        <div class="buttons">
            <div class="right"><a href="<?php echo site_url('account'); ?>" class="button"><?php echo $this->lang->line('Continue'); ?></a></div>
        </div>
    </div>
</div>
