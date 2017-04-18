<div class="box-content">
    <table class="table table-striped table-bordered bootstrap-datatable responsive">
        <?php if (count($orders) > 0): ?>
            <thead>
                <tr>
                    <th style="width:20%;">
                        <?php echo $this->lang->line('Order ID') . ' / ' . $this->lang->line('Date Added'); ?>
                    </th>

                    <th style="width:40%;">
                        <?php echo $this->lang->line('Address'); ?>
                    </th>
                    <th class="center">
                        <?php echo $this->lang->line('Sum'); ?>
                    </th>
                    <th class="center" style="width:20%;">
                        <?php echo $this->lang->line('Actions'); ?>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (is_array($orders) && count($orders) > 0) {
                    $status = array(
                        '-1' => '<span class="order_cancelled">' . $this->lang->line('Cancelled') . '</span>',
                        '0' => '<span class="order_pending">' . $this->lang->line('Delivery pending') . '</span>',
                        '1' => '<span class="order_success">' . $this->lang->line('Delivered') . '</span>',
                    );
                    foreach ($orders as $order) {
                        ?>
                        <?php $date = date_create($order->date_order); ?> 
                        <tr id="order_<?php echo $order->id; ?>">
                            <td class="image-in-list">
                                # <?php echo $order->id . ' / '; ?> <a href="<?php echo base_url('order/item/'.$order->id); ?>" ><?php echo date_format($date, 'd-m-Y'); ?></a>
                            </td>
                            <td>
                                <?php echo $order->address; ?>
                            </td>
                            <td  class="right">
                                <?php echo $order->order_sum . ' ' . $this->lang->line('AMD'); ?>
                            </td>
                            <td class="center order_status">
                                <a href="<?php echo site_url('order/item/'.$order->id); ?>"><?php echo $status[$order->status]; ?></a>
                            </td>
                        </tr>
                <?php } ?>
            <?php } ?>
            </tbody>
                <?php else: ?>
            <tr>
                <td>
            <?php echo $this->lang->line('No items to show.'); ?>
                </td>
            </tr>
<?php endif; ?>
    </table>
</div>



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

<?php if ($page_count > 1) { ?>
    <div class="results">
        <ul class="pagination pagination-centered">
            <li class="first-page <?php echo 1 == $page_number ? "disabled" : ""; ?>">
                <a href="" first-page="1"><?php echo $this->lang->line('First'); ?></a>
            </li>
            <li class="prev <?php echo 1 == $page_number ? "disabled" : ""; ?>">
                <a href="" first="1">«</a>
            </li>
            <?php for ($i = 1; $i <= $page_count; $i++) { ?>
        <?php if ($min_page_number <= $i && $i <= $max_page_number) { ?>
            <?php if ($page_number == $i) { ?>
                        <li class="disabled">
                            <a href=""><?php echo $i; ?></a>
                        </li>
            <?php } else { ?>
                        <li>
                            <a href=""><?php echo $i; ?></a>
                        </li>
                    <?php } ?>
        <?php } ?>
    <?php } ?>
            <li class="next <?php echo $page_count == $page_number ? "disabled" : ""; ?>" >
                <a href="" last="<?php echo $page_count ?>">»</a>
            </li>
            <li class="last-page <?php echo $page_count == $page_number ? "disabled" : ""; ?>" >
                <a href="" last-page="<?php echo $page_count ?>"><?php echo $this->lang->line('Last'); ?></a>
            </li>

        </ul>
    </div>
<?php } ?>
