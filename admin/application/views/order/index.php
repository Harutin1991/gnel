<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2>
                    <i class="glyphicon glyphicon-list-alt"></i> 
                    <?php echo $this->lang->line('Products'); ?>
                </h2>
                <div class="box-icon">
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
                </div>
            </div>
            <?php
            ?>
            <div class="pending_orders_wrapper">
                <div class="ord_status">
                    <select class="form-control" id="ord_status">
                        <option value=""><?php echo $this->lang->line('All'); ?></option>
                        <option <?php echo $ord_status == '-1' ? 'selected="selected"' : ''; ?> value="-1"><?php echo $this->lang->line('Cancelled'); ?></option>
                        <option <?php echo $ord_status == '0' ? 'selected="selected"' : ''; ?> value="0"><?php echo $this->lang->line('Delivery pending'); ?></option>
                        <option <?php echo $ord_status == '1' ? 'selected="selected"' : ''; ?> value="1"><?php echo $this->lang->line('Confirmed'); ?></option>
                    </select>
                </div>
                <div class="ord_perpage">
                    <select class="form-control" id="ord_perpage">
                        <option <?php echo $ord_perpage == 15 ? 'selected="selected"' : ''; ?> value="15">15</option>
                        <option <?php echo $ord_perpage == 30 ? 'selected="selected"' : ''; ?> value="30">30</option>
                        <option <?php echo $ord_perpage == 60 ? 'selected="selected"' : ''; ?> value="60">60</option>
                    </select>
                </div>
            </div>
            <img style="position:absolute;left:30%;top:70px;display:none;" class="ajax_loader" src="img/ajax_loader.gif" />
            <div id="data_table">
                <?php $this->load->view('order/datatable.php'); ?>
            </div>  


        </div>
    </div>
</div>








<script>
    $(document).ready(function() {


        $('#ord_status').change(function() {
            var status = $(this).val();
            $.cookie('ord_status', status, {expires: 1, path: '/'});
            ajax_filter(1);

        });
        $("#ord_perpage").change(function() {
            $.cookie('ord_perpage', $(this).val(), {expires: 1, path: '/'});
            ajax_filter(1);
        });
        $(document).on("click", ".pagination a", function() {
            var new_page = parseInt($(this).text());
            var page_number = parseInt($('.pagination li.disabled a').text());

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
            }
            return false;
        });
        /*
         $(".pagination a").click(function() {
         var new_page = parseInt($(this).text());
         var page_number = $(".pagination li.acitve").text();
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
         $.cookie('page_number_bapt', new_page);
         ajax_filter(new_page);
         }
         return false;
         });
         */

        function ajax_filter(ord_pagenum) {
            var ord_perpage = $('#ord_perpage').val();
            var ord_status = $('#ord_status').val();
            $('.ajax_loader').show();
            $.ajax({
                url: base_url + "ajax",
                dataType: 'json',
                type: 'post',
                data: {
                    action: 'order_filter',
                    ord_perpage: ord_perpage,
                    ord_pagenum: ord_pagenum,
                    ord_status: ord_status
                },
                success: function(data) {
                    console.log(data);
                    $('#data_table').html(data.html);
                    $('.ajax_loader').hide();
                }
            });
        }

/*
        $(document).on('click', 'span[status="change"]', function() {
            var $_this = $(this);
            var action = $(this).attr('action');
            var table = 'products';
            var id = $(this).attr('id');
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
                    if (action == 'enable') {
                        $_this.removeClass('label-danger');
                        $_this.addClass('label-success');
                        $_this.attr("action", "disable");
                        $_this.text('<?php echo $this->lang->line('Active'); ?>');
                    } else {
                        $_this.removeClass('label-success');
                        $_this.addClass('label-danger');
                        $_this.attr("action", "enable");
                        $_this.text('<?php echo $this->lang->line('Banned'); ?>');
                    }
                    //location.reload();
                }
            });
        });

        $('.delete').click(function() {
            var id = $(this).attr('item_id');

            $.msgBox({
                title: '<?php echo $this->lang->line('Delete'); ?>',
                content: '<?php echo $this->lang->line('Are you sure you want to delete product?'); ?>',
                type: "error",
                buttons: [{value: '<?php echo $this->lang->line('Yes'); ?>'}, {value: '<?php echo $this->lang->line('No'); ?>'}],
                success: function(result) {
                    if (result == '<?php echo $this->lang->line('Yes'); ?>') {
                        $.ajax({
                            url: base_url + "ajax",
                            dataType: 'json',
                            type: 'post',
                            data: {'action': 'delete_product', 'id': id},
                            success: function(data) {
                                if (data.success == true)
                                    $('#' + id).fadeOut(2000, function() {
                                        $(this).remove();
                                    });
                            }
                        });
                    }
                    else if (result == '<?php echo $this->lang->line('No'); ?>') {

                    }
                }
            });
        });
*/
    });
</script>

