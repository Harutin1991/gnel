<?php // var_dump($order); exit;?>
<div id="content">
    <h1><span class="h1-top">Order Information</span></h1>
    <div class="information_content">
        <table class="list">
            <thead>
                <tr>
                    <td class="left" colspan="2">Order Details</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="left" style="width: 50%;"><b>Order ID:</b> #<?php echo $order_id; ?><br>
                        <?php $date = date_create($order[0]->date_created); ?> 
                        <b>Date Added:</b> <?php echo date_format($date, 'd/m/Y'); ?></td>
                    <td class="left" style="width: 50%;"><b>Payment Method:</b> Cash On Delivery<br>
                </tr>
            </tbody>
        </table>
        <table class="list">
            <thead>
                <tr>
                    <td class="left">Payer</td>
                    <td class="left">Shipping Address</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="left"><?php echo $order[0]->first_name . ' ' . $order[0]->last_name; ?><br/>
                    </td>
                    <td class="left"><?php echo $order[0]->ship_first_name . ' ' . $order[0]->ship_last_name; ?><br>
                        <?php echo $order[0]->ship_address; ?><br>
                        <?php echo $order[0]->email; ?><br>
                        <?php echo $order[0]->phone; ?><br>
                        <?php echo $order[0]->city_name; ?><br>
                        <?php echo $order[0]->country_name; ?></td>
                </tr>
            </tbody>
        </table>
        <table class="list order-products-info" border="1 dotted">
            <thead>
                <tr>
                    <td class="left">Image</td>
                    <td class="left">Product Name</td>
                    <td class="left">Code</td>
                    <td class="right">Quantity</td>
                    <td class="right">Price</td>
                    <td class="right">Total</td>
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
                            <td class="left"><a href="<?php echo $product_url; ?>" target="_blank"><img src="<?php echo thumbImg($img_url, 50, 50); ?>"/></a></td>
                            <td class="left"><a href="<?php echo $product_url; ?>" target="_blank"><?php echo $product->product_name; ?></a></td>
                            <td class="left"><?php echo $product->code; ?></td>
                            <td class="right"><?php echo $product->product_qty; ?></td>
                            <td class="right"><?php echo $product->product_price . ' ' . $this->lang->line('AMD'); ?></td>
                            <td class="right"><?php echo $subtotal . ' ' . $this->lang->line('AMD'); ?></td>
                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr><td>No products selected in this order</td></tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4"></td>
                    <td class="right"><b><?php echo $this->lang->line('Total:'); ?></b></td>
                    <td class="right"><?php echo $cart['total'] . ' ' . $this->lang->line('AMD'); ?></td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                    <td class="right"><b><?php echo $this->lang->line('Delivery:'); ?></b></td>
                    <td class="right"><?php echo $order[0]->delivery_price . ' ' . $this->lang->line('AMD'); ?></td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                    <td class="right"><b><?php echo $this->lang->line('Total:'); ?></b></td>
                    <td class="right"><?php echo $cart['total'] + $order[0]->delivery_price . ' ' . $this->lang->line('AMD'); ?></td>
                </tr>
            </tfoot>
        </table>
        <table class="list">
            <thead>
                <tr>
                    <td class="left">Order Comments</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="left"><?php echo $order[0]->comment; ?></td>
                </tr>
            </tbody>
        </table>
        <?php
        $status = array(
            '-1' => '<span class="order_status label-default label label-danger" status="change" action="cancel">' . $this->lang->line('Cancel') . '</span>',
            '0' => '<span class="order_status label-default label label-warning" status="change" action="disable">' . $this->lang->line('Pending') . '</span>',
            '1' => '<span class="order_status label-default label label-success" status="change" action="enable">' . $this->lang->line('Confirm') . '</span>',
        );
        $status_ = array(
            '-1' => $this->lang->line("Cancelled"),
            '0' => $this->lang->line('Delivery pending'),
            '1' => $this->lang->line('Confirmed')
            );
        ?>
        <table class="list">
            <tr>
                <td>

                    <p><span>
                            <?php echo $this->lang->line('Status:') . ' ' . $status_[$order[0]->order_status]; ?> 
                        </span>
                    </p>
                    <p style="text-align: right;">
                        <span style="float: right;">
                            <?php echo $this->lang->line('Action'); ?> 
                            <?php
                            foreach ($status AS $key => $val) {
                                if ($order[0]->order_status != $key) {
                                    echo $val . ' ';
                                }
                            }
                            ?>
                        </span>
                    </p>
                    <input type="hidden" name="order_id" value="<?php echo $order_id; ?>" />

                </td>
            </tr>
        </table>
    </div>
</div>
<input type="button" onclick="printDiv('content')" value="Print Invoice" />
<script type="text/javascript">
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
    
    jQuery(document).ready(function($) {
        $(document).on('click', 'span[status="change"]', function() {
            var $_this = $(this);
            var action = $(this).attr('action');
            var table = 'orders';
            var id = $('input[name=order_id]').val();
            $.ajax({
                url: base_url + "ajax",
                dataType: 'json',
                type: 'post',
                beforeSend: function() {
                    $_this.hide();
                    $_this.after($("<img/>").attr({
                        src: base_url + "img/edit_spinner.gif",
                        height: "21px",
                        width: "21px",
                        id: "spinner"
                    }).css("visibility", "visible"));
                },
                data: {'action': action, 'table': table, 'id': id, },
                success: function(data) {
                    $("#spinner").remove();
                    $_this.show();

                    location.reload();
                }
            });
        });
    });
</script>