<div id="content">
    <div class="breadcrumb"> <a href="<?php echo site_url(); ?>"><?php echo $this->lang->line('Home'); ?></a> » <a href="<?php echo site_url('account/'); ?>"><?php echo $this->lang->line('Account'); ?></a> » <?php echo $this->lang->line('Order History'); ?> </div>
    <h1><span class="h1-top"><?php echo $this->lang->line('Order History'); ?></span></h1>
    <div style="float: right;">
        <select class="selectBox" id="perpage_select" style="display: none">
            <option value="5" <?php echo $od_perpage == 5 ? 'selected="selected"' : ''; ?>>5</option>
            <option value="10" <?php echo $od_perpage == 10 ? 'selected="selected"' : ''; ?>>10</option>
            <option value="15" <?php echo $od_perpage == 15 ? 'selected="selected"' : ''; ?>>15</option>
        </select>
    </div>
    <img style="position:absolute;left:30%;top:70px;display:none;" class="ajax_loader" src="<?php echo base_url(); ?>images/icons/ajax-loader1.gif" />
    <div class="information_content">
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
    </div>
</div>

<script type="text/javascript" >
    $(document).ready(function() {

        $("#perpage_select").change(function() {
            $.cookie('od_perpage', $(this).val(), {expires: 1, path: '/'});
            ajax_filter(1);
        });

        $(document).on("click", ".pagination a", function() {
            //document.getElementById("scroll_to").scrollIntoView();
            var new_page = parseInt($(this).text());
            var page_number = parseInt($('.pagination a.active').text());
            if ($(this).attr('first-page') !== undefined) {
                var new_page = 1;
            } else if ($(this).attr('last-page') !== undefined) {
                var new_page = parseInt($(this).attr('last-page'));
            } else if ($(this).attr('first') !== undefined) {
                var new_page = page_number > 1 ? page_number - 1 : 1;

            } else if ($(this).attr('last') !== undefined) {
                var last_page = parseInt($(this).attr('last'));
                var new_page = page_number == last_page ? page_number : page_number + 1;
            } else {
                var new_page = parseInt($(this).text());
            }
            if (new_page != page_number) {
                ajax_filter(new_page);
                $('.active').removeClass('active');
                $(this).addClass('active');
            }
            return false;
        });

        function ajax_filter(od_pagenum) {
            var od_perpage = $('#perpage_select').val();
            $('.ajax_loader').show();
            $.ajax({
                url: site_url + "ajax",
                dataType: 'html',
                type: 'post',
                data: {
                    action:       'orderhistory_filter',
                    od_pagenum:  od_pagenum,
                    od_perpage: od_perpage,
                },
                success: function(data) {
                    $('.information_content').html('');
                    $('.information_content').html(data);
                    $('.ajax_loader').hide();
                }
            });
        }



    });


</script>