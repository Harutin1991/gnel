
<div id="content">
    <div class="breadcrumb"> <a href="<?php echo site_url(); ?>"><?php echo $this->lang->line('Home'); ?></a> » <?php echo $this->lang->line('Shopping Cart'); ?> </div>
    <h1><span class="h1-top"><?php echo $this->lang->line('Shopping Cart'); ?> </span></h1>
    <!--<form action="shoppingcart.html" method="post" enctype="multipart/form-data">-->
    <div class="cart-info">
        <table>
            <thead>
                <tr>
                    <td class="image"><?php echo $this->lang->line('Image'); ?></td>
                    <td class="name"><?php echo $this->lang->line('Product Name'); ?></td>
                    <td class="model"><?php echo $this->lang->line('Code'); ?></td>
                    <td class="quantity"><?php echo $this->lang->line('Quantity'); ?></td>
                    <td class="price"><?php echo $this->lang->line('Price'); ?></td>
                    <td class="total"><?php echo $this->lang->line('Total'); ?></td>
                    <td class="product-acition"><?php echo $this->lang->line('Delete'); ?></td>
                </tr>
            </thead>
            <tbody class="cart-info-body">


                <?php
                $cart['total'] = 0;
                $cart['quantity'] = 0;
                $cart['html'] = '';
                foreach ($shopping_cart AS $product) {
                    $subtotal = intval($product->total_amount);

                    $cart['total'] += $subtotal;
                    $cart['quantity'] += intval($product->quantity);
                    $product_url = product_url($product->id, $product->name);
                    $image_url = prodImg($product->id, $product->image);
                    $thumb_url = thumbImg($image_url, 200, 200);
                    $cart['html'] .= '<tr>';
                    $cart['html'] .= '<td colspan="6" class="emptyrow"></td>';
                    $cart['html'] .= '</tr>';
                    $cart['html'] .= '<tr>';

                    $sale_for_table = '';
                    if($product->percent_off != 0) {
                        $sale_for_table = $product->percent_off . "%";
                    }
                    if($product->amount_off != 0) {
                        $sale_for_table = $this->lang->line('Sale');
                    }

                    $cart['html'] .= '<td class="image">';
                    if($sale_for_table != ''){
                        $cart['html'] .= '<span class="sale_for_table">'.$sale_for_table.'</span>';
                    }
                    $cart['html'] .= '<a href="' . $product_url . '"><img src="' . $thumb_url . '" alt="' . $product->name . '" title="' . $product->name . '"></a></td>';
                    $cart['html'] .= '<td class="name"><a href="' . $product_url . '">' . $product->name . '</a>';
                    $cart['html'] .= '<div> </div></td>';
                    $cart['html'] .= '<td class="model">' . $product->code . '</td>';
                    $cart['html'] .= '<td class="quantity quantity_loader"><input type="text" name="product-quantity" value="' . $product->quantity . '" size="1" prod-id="' . $product->id . '"></td>';
                    $cart['html'] .= '<td class="price">' . $product->total_amount/$product->quantity . ' ' . $this->lang->line('AMD') . '</td>';
                    $cart['html'] .= '<td class="total" prod-id="' . $product->id . '">' . $subtotal . ' ' . $this->lang->line('AMD') . '<br/';
                    $cart['html'] .= '<div class="reload">';
                    $cart['html'] .= '</div></td>';
                    $cart['html'] .= '<td class="product-acition"><span class="icon icon-nomargin icon-floatright"><i class="fa fa-times fa-fw remove-product-from-cart" product-id="' . $product->id . '"></i></span></td>';

                    $cart['html'] .= '</tr>';
                    $cart['html'] .= '<tr>';
                    $cart['html'] .= '<td colspan="6" class="emptyrow"></td>';
                    $cart['html'] .= '</tr>';
                }

                $cart['delivery'] = $delivery_price > 0 ? $delivery_price : ($cart['total'] >= $static_delivery_price ? 0 : $min_delivery_price);
                ?>

                <?php echo $cart['html']; ?>
            </tbody>
        </table>
    </div>
    <!--</form>-->
    <h2><?php echo $this->lang->line('What would you like to do next?'); ?></h2>
    <div class="cart-total">
        <table id="total">
            <tbody>
                <tr>
                    <td class="right"><b><?php echo $this->lang->line('Total:'); ?></b></td>
                    <td class="right last shopping-cart-subtotal"><?php echo $cart['total'] . ' ' . $this->lang->line('AMD'); ?></td>
                </tr>
                <tr>
                    <td class="right"><b><?php echo $this->lang->line('Delivery:'); ?></b></td>
                    <td class="right last shopping-cart-delivery"><?php echo $cart['delivery'] . ' ' . $this->lang->line('AMD'); ?></td>
                </tr>
                <tr>
                    <td class="right lastrow"><b><?php echo $this->lang->line('Total:'); ?></b></td>
                    <td class="right last lastrow shopping-cart-total"><?php echo $cart['total'] + $cart['delivery'] . ' ' . $this->lang->line('AMD'); ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="buttons buttons_size">
        <div class="right"><a href="<?php echo site_url('shopping/checkout'); ?>" class="button"><?php echo $this->lang->line('Checkout'); ?></a></div>
        <div class="center"><a href="<?php echo site_url(''); ?>" class="button"><?php echo $this->lang->line('Continue Shopping'); ?></a></div>
    </div>
</div>
<script>
    window.delivery_price = <?php echo isset($delivery_price) ? $delivery_price : 0; ?>;
    window.delivery_city_id = <?php echo isset($delivery_city_id) ? $delivery_city_id : 1; ?>;
    window.min_delivery_price = <?php echo isset($min_delivery_price) ? $min_delivery_price : 1000; ?>;
    window.static_delivery_price = <?php echo isset($static_delivery_price) ? $static_delivery_price : 15000; ?>;
    window.city_price = [];

<?php if (isset($city_price) && is_array($city_price)) { ?>
    <?php foreach ($city_price AS $id => $city) { ?>
        city_price[<?php echo  $id; ?>] = '<?php echo $city['price']; ?>';
    <?php } ?>
<?php } ?>
</script>