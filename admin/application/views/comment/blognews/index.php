<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2>
                    <i class="glyphicon glyphicon-list-alt"></i> 
                    <?php echo $this->lang->line('Blognews'); ?>
                </h2>
                <div class="box-icon">
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
                </div>
            </div>
            <?php
            ?>
            <input type="text" class="search form-control" value="<?php echo $bg_string; ?>" id="pr_string"/>
            <div class="pending_comment_checkbox_wrapper">
                <input type="checkbox" name="pending" value="1" <?php echo $bg_pending == 1 ? 'checked="checked"' : ''; ?> />
                <?php echo $this->lang->line('Show products with pending comments'); ?>
            </div>
            <select class="per_page form-control" id="pr_perpage">
                <option <?php echo $bg_perpage == 15 ? 'selected="selected"' : ''; ?> value="15">15</option>
                <option <?php echo $bg_perpage == 30 ? 'selected="selected"' : ''; ?> value="30">30</option>
                <option <?php echo $bg_perpage == 60 ? 'selected="selected"' : ''; ?> value="60">60</option>
            </select>
            <img style="position:absolute;left:30%;top:70px;display:none;" class="ajax_loader" src="img/ajax_loader.gif" />
            <div id="data_table">
                <?php $this->load->view('comment/blognews/datatable.php'); ?>
            </div>  


        </div>
    </div>
</div>








<script>
    $(document).ready(function() {

        var last_bg_string = $("#pr_string").val();
        last_bg_string = last_bg_string.trim();
        $("#pr_string").keyup(function() {
            var bg_string = $(this).val();
            bg_string = bg_string.trim();
            if (bg_string != last_bg_string) {
                $.cookie('bg_string', bg_string, {expires: 1, path: '/'});
                last_bg_string = bg_string;
                ajax_filter(1);
            }
        });
        $('input[name=pending]').change(function(){
            var pending = $(this).is(':checked') ? 1 : 0;
            $.cookie('bg_pending', pending, {expires: 1, path: '/'});
            ajax_filter(1);

        });
        $("#pr_perpage").change(function() {
            $.cookie('bg_perpage', $(this).val(), {expires: 1, path: '/'});
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

        function ajax_filter(bg_pagenum) {
            var bg_string  = $('#pr_string').val();
            var bg_perpage = $('#pr_perpage').val();
            var bg_pending = $('input[name=pending]').is(':checked') ? 1 : 0;
            $('.ajax_loader').show();
            $.ajax({
                url: base_url + "ajax",
                dataType: 'html',
                type: 'post',
                data: {
                    action: 'blognews_comment_filter',
                    bg_string: bg_string,
                    bg_perpage: bg_perpage,
                    bg_pagenum: bg_pagenum,
                    bg_pending: bg_pending
                },
                success: function(data) {
                    console.log(data);
                    $('#data_table').html(data);
                    $('.ajax_loader').hide();
                }
            });
        }


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

    });
</script>
