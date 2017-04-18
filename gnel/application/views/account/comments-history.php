
<div id="content">
    <div class="breadcrumb"> <a href="<?php echo site_url(); ?>"><?php echo $this->lang->line('Home'); ?></a> » <a href="<?php echo site_url('account/'); ?>"><?php echo $this->lang->line('Account'); ?></a> » <?php echo $this->lang->line('Comments'); ?> </div>
    <h1><span class="h1-top"><?php echo $this->lang->line('My Comments'); ?></span></h1>
    <div class="search" style="float:left;">
        <input type="text" name="search" placeholder="Փնտրել" value="" id="pr_string">
    </div>
    <div style="float: right;">
        <select class="selectBox" id="perpage_select" style="display: none">
            <option value="5" <?php echo $pr_perpage == 5 ? 'selected="selected"' : ''; ?>>5</option>
            <option value="10" <?php echo $pr_perpage == 10 ? 'selected="selected"' : ''; ?>>10</option>
            <option value="15" <?php echo $pr_perpage == 15 ? 'selected="selected"' : ''; ?>>15</option>
        </select>
    </div>
    <img style="position:absolute;left:30%;top:70px;display:none;" class="ajax_loader" src="<?php echo base_url(); ?>images/icons/ajax-loader1.gif" />
    <div class="information_content">
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
    </div>

</div>



<script type="text/javascript" >
    $(document).ready(function() {
        function textAreaAdjust(o) {
            console.log(o);
            o.style.height = "1px";
            o.style.height = (25+o.scrollHeight)+"px";
        }
        $(document).on('keyup', '#edit_comment_text', function(ev){
            textAreaAdjust(this);
        });

//        $('.simple-comment').hover(function () {
//            if ($(this).find('textarea').length == '0') {
//                var comment_td = $(this);
//                var button = $("<img/>").attr({
//                    'type': 'button',
//                    'class': 'edit_comment',
//                    'name': 'edit_comment',
//                    'comment-id': comment_td.attr('com-id'),
//                    'src': '<?php //echo base_url('images/icons/edit-icon2.png'); ?>//'
//                });
//                comment_td.append(button);
//                $('.edit_comment').css({'width': '15px', 'position':'absolute', 'margin-left':'10px;', });
//            }
//        }, function () {
//            $("img[comment-id=" + $(this).attr('com-id') + "]").remove();
//        });
        var current_text;
        $(document).on('click', 'img.edit_comment', function () {
            var parent = $(this).parent('.simple-comment');
            var comment_id = $(this).attr('comment-id');
            var span_obj = parent.find('span');
            var input = $("<textarea/>").attr({
                'class': 'form-control',
                'id': 'edit_comment_text',
                'style': 'width:100%; margin-top:0; resize:none; border-radius: 0; border:1px solid #ddd; line-height: 20px; font-size: 12px;  min-height:' + span_obj.height() + 'px;',
                'name': 'edit_comment_text_area',
                'comment-id': comment_id
            });

            var text = parent.find('span').text();
            input.val(text);
            current_text = text;
            parent.find('span').empty().append(input);
            var new_input = parent.find('textarea');
            var val1 = new_input.val();
            new_input.focus().val("").val(val1);
            parent.find('img').css({'display': 'none' });
        });

        $(document).on('blur', 'textarea[name=edit_comment_text_area]', function () {
            var parent = $(this).parent();
            var $_this = $(this);
            var table_name = $('.list').attr('table_name');
            var text = $(this).val();
            var comment_id = $(this).attr('comment-id');
            $('img.edit_comment').css({'display': 'block' });
            if (current_text != text) {
                $.ajax({
                    url: base_url + "ajax",
                    dataType: 'json',
                    type: 'post',
                    beforeSend: function () {
                        parent.empty();
                        $_this.after($("<img/>").attr({
                            src: base_url + "images/icons/spinner.gif",
                            height: "21px",
                            width: "21px",
                            id: "spinner"
                        }).css("visibility", "visible"));
                    },
                    data: {'action': 'update_comment', 'table_name': table_name, 'text': text, 'id': comment_id,},
                    success: function (data) {
                        console.log(data);
                        $("#spinner").remove();
                        if (data.success) {
                            current_text = text;
                        }else{
                            parent.text(current_text);
                        }
                    }
                });
            }
            parent.text(text);
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

        var last_pr_string = $("#pr_string").val();
        last_pr_string = last_pr_string.trim();
        $("#pr_string").keyup(function() {
            var pr_string = $(this).val();
            pr_string = pr_string.trim();
            if (pr_string != last_pr_string) {
                var table_name = $('.list').attr('table_name');
                $.cookie(table_name+'_string', pr_string, {expires: 1, path: '/'});
                last_pr_string = pr_string;
                ajax_filter(1);
            }
        });
        $("#perpage_select").change(function() {
            var table_name = $('.list').attr('table_name') == 'blognews' ? 'blognews_comments' : 'product_comments';

            $.cookie(table_name+'_perpage', $(this).val(), {expires: 1, path: '/'});
            ajax_filter(1);
        })

        function ajax_filter(blg_pagenum) {
            var pr_string = $('#pr_string').val();
            var pr_perpage = $('#perpage_select').val();
            var table_name = $('.list').attr('table_name');
            $('.ajax_loader').show();
            $.ajax({
                url: site_url + "ajax",
                dataType: 'html',
                type: 'post',
                data: {
                    action:       'all_comments_filter',
                    blg_pagenum:  blg_pagenum,
                    pr_string: pr_string,
                    pr_perpage: pr_perpage,
                    table_name:   table_name
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