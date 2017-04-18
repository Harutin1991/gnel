<table class="list">
    <thead>
    <tr>
        <td class="left center"><?php echo $this->lang->line('Order ID'); ?></td>
        <td class="left center"><?php echo $this->lang->line('Date Added'); ?></td>
        <td class="left center"><?php echo $this->lang->line('Sum'); ?></td>
        <td class="left center"><?php echo $this->lang->line('Status'); ?></td>
    </tr>
    </thead>
    <?php $status = array(
        '-1' => '<span class="order_status cancelled">'.$this->lang->line('Cancelled').'</span>',
        '0' => '<span class="order_status pending">'.$this->lang->line('Delivery pending').'</span>',
        '1' => '<span class="order_status delivered">'.$this->lang->line('Delivered').'</span>',
    ); ?>
    <tbody>
    <?php if (!empty($orders)) { ?>
        <?php foreach ($orders AS $order) { ?>
            <?php $date = date_create($order->date_order); ?>
            <tr>
                <td class="left center"># <?php echo $order->id; ?></td>
                <td class="left center"><a href="<?php echo site_url('account/orderinfo/'.$order->id); ?>"><?php echo date_format($date, 'd-m-Y'); ?></a></td>
                <td class="left center"><?php echo $order->sum; ?></td>
                <td class="left center"><?php echo $status[$order->status]; ?></td>
            </tr>
        <?php } ?>
    <?php } else { ?>
        <tr>
            <td colspan="4"><?php echo $this->lang->line('You dont have any orders.'); ?> </td>
        </tr>

    <?php } ?>
    </tbody>
</table>
<!-- Pagination START -->
<?php
// get show page range
$show_pages = array();
$show_page_count = 10;
if ($show_page_count > $page_count) {
    $min_page_number = 1;
    $max_page_number = $page_count;
} else {
    if ($page_number > $show_page_count / 2) {
        if ($show_page_count / 2 + $page_number <= $page_count) {
            $min_page_number = $page_number - $show_page_count / 2;
            $max_page_number = $min_page_number + $show_page_count;
        } else {
            $min_page_number = $page_count - $show_page_count;
            $max_page_number = $page_count;
        }
    } else {
        $min_page_number = 1;
        $max_page_number = $min_page_number + $show_page_count;
    }
}
?>
<!--
        <div class="pagination">
            <div class="results">Showing <?php echo $page_number; ?>  to <?php echo $max_page_number; ?> of <?php echo $min_page_number; ?> </div>
        </div>
        -->

<div class="pagination">
    <?php if ($page_count > 1) { ?>
        <div class="results">
            <ul class="pagination-centered">
                <li class="first-page <?php echo 1 == $page_number ? "disabled" : ""; ?>">
                    <a  first-page="1"><?php echo $this->lang->line('First'); ?></a>
                </li>
                <li class="prev <?php echo 1 == $page_number ? "disabled" : ""; ?>">
                    <a  first="1">«</a>
                </li>
                <?php for ($i = 1; $i <= $page_count; $i++) { ?>
                    <?php if ($min_page_number <= $i && $i <= $max_page_number) { ?>
                        <?php if ($page_number == $i) { ?>
                            <li >
                                <a class="active">
                                    <?php echo $i; ?>
                                </a>
                            </li>
                        <?php } else { ?>
                            <li>
                                <a ><?php echo $i; ?></a>
                            </li>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>
                <li class="next <?php echo $page_count == $page_number ? "disabled" : ""; ?>" >
                    <a  last="<?php echo $page_count ?>">»</a>
                </li>
                <li class="last-page <?php echo $page_count == $page_number ? "disabled" : ""; ?>" >
                    <a  last-page="<?php echo $page_count ?>"><?php echo $this->lang->line('Last'); ?></a>
                </li>

            </ul>
        </div>
    <?php } ?>
</div>
<div class="buttons">
    <div class="right"><a href="<?php echo site_url('account'); ?>" class="button"><?php echo $this->lang->line('Continue'); ?></a></div>
</div>