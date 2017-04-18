<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2>
                    <i class="glyphicon glyphicon-list-alt"></i> 
                    <?php echo $this->lang->line('Categories'); ?>
                </h2>
                <div class="box-icon">
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
                </div>
            </div>
            <div class="box-content">
                <table>
                    <tbody>
                        <?php if (count($categories) > 0) { ?>
                        <div>
                            <?php echo get_category_html($categories, array('class' => 'dd', 'id' => 'nestable3')); ?>
                            <br />
                            <span id="save" class="btn btn-primary"><?php echo $this->lang->line('Save order'); ?></span>
                        </div>
                    <?php } else { ?>
                        <tr>
                            <td>
                                <?php echo $this->lang->line('No items to show.'); ?>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#save').click(function() {
            items = $('#nestable3').nestable('toArray');
            console.log(JSON.stringify(items))
            //    item_id = 0;

            $.ajax({
                url: base_url + "ajax",
                dataType: 'json',
                type: 'post',
                data: {
                    action: 'save_categories',
                    items: JSON.stringify(items),
                    childCategories: <?php echo json_encode($childCategories); ?>,
                    //  menu_id: 0
                },
                success: function(data) {
                    if (data.success == true) {
                        //  alert('OK');
                    }
                    else if (data.success == false) {
                        if (data.message != undefined)
                            alert(data.message);
                    }
                }
            });
        });

        $('.delete').click(function() {
            var id = $(this).attr('item_id');

            $.msgBox({
                title: '<?php echo $this->lang->line('Delete'); ?>',
                content: '<?php echo $this->lang->line('Are you sure you want to delete category?'); ?>',
                type: "error",
                buttons: [
                    {value: '<?php echo $this->lang->line('Yes'); ?>'},
                    {value: '<?php echo $this->lang->line('No'); ?>'}
                ],
                success: function(result) {
                    if (result == '<?php echo $this->lang->line('Yes'); ?>') {
                        $.ajax({
                            url: base_url + "ajax",
                            dataType: 'json',
                            type: 'post',
                            data: {'action': 'delete_category', 'id': id},
                            success: function(data) {
                                if (data.success == true) {
                                    $('#' + id).fadeOut(2000, function() {
                                        $(this).remove();
                                    });
                                }
                                else if (data.success == false) {
                                    if (data.message != undefined)
                                        alert(data.message);
                                }
                            }
                        });
                    }
                    else if (result == '<?php echo $this->lang->line('No'); ?>') {

                    }
                }
            });
        });

        $('span[status="change"]').click(function() {
            var action = $(this).attr('action');
            var table = 'categories';
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
    });
</script>

