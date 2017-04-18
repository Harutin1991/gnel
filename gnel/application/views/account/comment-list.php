    <table class="list" table_name="<?php echo $comment_type; ?>">
        <thead>
        <tr>
            <!--                <td class="left center">--><?php //echo $this->lang->line('Order ID'); ?><!--</td>-->
            <td class="left center"><?php echo $this->lang->line('Image'); ?></td>
            <td class="left center"><?php echo $this->lang->line('Title'); ?></td>
            <td class="left center"><?php echo $this->lang->line('Comment'); ?></td>
            <td class="left center min_hide"><?php echo $this->lang->line('Date Added'); ?></td>
            <td class="left center"><?php echo $this->lang->line('Status'); ?></td>
        </tr>
        </thead>
        <!--            --><?php //$status = array(
        //                '-1' => '<span class="order_status cancelled">'.$this->lang->line('Cancelled').'</span>',
        //                '0' => '<span class="order_status pending">'.$this->lang->line('Delivery pending').'</span>',
        //                '1' => '<span class="order_status delivered">'.$this->lang->line('Delivered').'</span>',
        //            ); ?>
        <tbody>
        <?php if (!empty($comments)) {  //echo "<pre>"; var_dump($page_count);exit; ?>
            <?php foreach ($comments AS $comment) { ?>
                <?php $date = date_create($comment->comment_date); ?>
                <tr>
                    <!--                        <td class="left center"># --><?php //echo $order->id; ?><!--</td>-->
                    <td class="left center">
                        <?php
                        $img_url = $comment_type == 'blognews' ? base_url().'images/blognews/'.$comment->image : prodImg($comment->item_id, $comment->image);
                        $img_url = thumbImg($img_url, 50, 50);
                        $url = $comment_type == 'blognews' ? blognews_url($comment->item_id, $comment->name) : product_url($comment->item_id, $comment->name);
                        ?>
                        <a href="<?php echo $url; ?>"><img src="<?php echo $img_url; ?>"/><a/>
                    </td>
                    <td class="left center comment_title"><a href="<?php echo $url; ?>"><?php echo $comment->name; ?></a></td>
                    <td class="left center edit_td <?php echo $comment->status != '1' ? 'simple-comment' : '' ; ?>" com-id="<?php echo $comment->id; ?>">
                        <span ><?php echo $comment->comment; ?></span>
                        <?php if($comment->status != '1') { ?>
                            <img type="button" class="edit_comment" name="edit_comment" comment-id="62" src="http://babybuy.am/images/icons/edit-icon2.png" alt="edit" title="<?php echo $this->lang->line('Edit'); ?>"/>
                        <?php } ?>
                    </td>
                    <td class="left center min_hide"><?php echo date_format($date, 'd-m-Y'); ?></td>
                    <td class="left center">
                        <?php if ($comment->status == "1") { ?>
                            <span class="order_status  delivered" ><?php echo $this->lang->line('Active'); ?></span>
                        <?php } else { ?>
                            <span class="order_status pending " ><?php echo $this->lang->line('Pending'); ?></span>
                            <span class="order_status pending pending_for_min" ><?php echo $this->lang->line('Pending_min'); ?></span>
                        <?php } ?>
                    </td>
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