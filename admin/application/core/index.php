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
$string = '';$per_page = 5;
?>
            <input type="text" class="search" value="<?php echo $string; ?>" />
            <select class="per_page">
                <option <?php echo $per_page == 5 ? 'selected="selected"' : ''; ?> value="5">5</option>
                <option <?php echo $per_page == 10 ? 'selected="selected"' : ''; ?> value="10">10</option>
                <option <?php echo $per_page == 20 ? 'selected="selected"' : ''; ?> value="20">20</option>
                <option <?php echo $per_page == 50 ? 'selected="selected"' : ''; ?> value="50">50</option>
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

        $('span[status="change"]').click(function() {
            var action = $(this).attr('action');
            var table = 'products';
            var id = $(this).attr('id');
            $.ajax({
                url: base_url + "ajax",
                dataType: 'json',
                type: 'post',
                data: {'action': action, 'table': table, 'id': id, },
                success: function(data) {
                    location.reload();
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
                                    $('#tr_' + id).fadeOut(2000, function() {
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

