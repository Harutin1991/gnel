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
            <input type="text" class="search form-control" value="<?php echo $pr_string; ?>" id="pr_string"/>
            <?php if(isset($id)) { ?>
                <a href="<?php echo base_url("product/index/" . $id); ?>" class="btn btn-primary" role="button"><?php echo $this->lang->line('Show products'); ?></a>
                <button type="button" class="btn btn-primary" id="<?php echo $id ?>"><?php echo $this->lang->line('Sale products'); ?></button>
            <?php } ?>
            <select class="per_page form-control" id="pr_perpage">
                <option <?php echo $pr_perpage == 15 ? 'selected="selected"' : ''; ?> value="15">15</option>
                <option <?php echo $pr_perpage == 30 ? 'selected="selected"' : ''; ?> value="30">30</option>
                <option <?php echo $pr_perpage == 60 ? 'selected="selected"' : ''; ?> value="60">60</option>
            </select>
            <img style="position:absolute;left:30%;top:70px;display:none;" class="ajax_loader" src="img/ajax_loader.gif" />
            <div id="data_table">
                <?php $this->load->view('product/datatable.php'); ?>
            </div>  


        </div>
    </div>
</div>




<script>
    $(document).ready(function() {

        var last_pr_string = $("#pr_string").val();
        last_pr_string = last_pr_string.trim();
        $("#pr_string").keyup(function() {
            var pr_string = $(this).val();
            pr_string = pr_string.trim();
            if (pr_string != last_pr_string) {
                $.cookie('pr_string', pr_string, {expires: 1, path: '/'});
                last_pr_string = pr_string;
                ajax_filter(1);
            }
        });

        $("#pr_perpage").change(function() {
            $.cookie('pr_perpage', $(this).val(), {expires: 1, path: '/'});
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

        function ajax_filter(pr_pagenum) {
            var pr_string = $('#pr_string').val();
            var pr_perpage = $('#pr_perpage').val();
            $('.ajax_loader').show();
            $.ajax({
                url: base_url + "ajax",
                dataType: 'json',
                type: 'post',
                data: {
                    action: 'product_filter',
                    pr_string: pr_string,
                    pr_perpage: pr_perpage,
                    pr_pagenum: pr_pagenum
                },
                success: function(data) {
                    console.log(data);
                    $('#data_table').html(data.html);
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
                data: {'action': action, 'table': table, 'id': id },
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

        $(document).on('click', 'button.btn-primary', function() {
            var id = $(this).attr('id');
            $('.ajax_loader').show();
            $.ajax({
                url: base_url + "ajax",
                dataType: 'json',
                type: 'post',
                data: {'action': 'get_sale_products', 'id': id },
                success: function(data) {
                    $('#data_table').html(data.html);
                    $('.ajax_loader').hide();
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

