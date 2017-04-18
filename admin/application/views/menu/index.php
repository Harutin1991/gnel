ՙ<h3><?php echo $this->lang->line('Menus'); ?></h3>

<table class="table table-striped table-bordered bootstrap-datatable responsive">
    <?php if(count($menus) > 0): ?>
        <thead>
            <tr>
               <th>
                  <?php echo $this->lang->line('Name'); ?>
                </th>
                <th style="width:500px;">
                  <?php echo $this->lang->line('Actions'); ?>
                </th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($menus as $item): ?>
            <tr id="td<?php echo $item->id; ?>">
                <td>
                    <?php echo $item->name; ?>
                </td>
                <td>
                    <?php if ($this->session->userdata('admin_id') == 1 || in_array('menu/edit', $this->permission)) { ?>
                    <a class="btn btn-info" href="<?php echo base_url("menu/edit/" . $item->id); ?>" >
                        <i class="glyphicon glyphicon-edit icon-white"></i>
                        <?php echo $this->lang->line('Edit'); ?>
                    </a>
                    <?php } ?>
                    <?php if ($this->session->userdata('admin_id') == 1 || in_array('menu/addItem', $this->permission)) { ?>
                    <a class="btn btn-primary" href="<?php echo base_url("menu/addItem/" . $item->id); ?>" >
                        <i class="glyphicon glyphicon-plus icon-white"></i>
                        <?php echo $this->lang->line('Add items'); ?>
                    </a>
                    <?php } ?>
                    <?php if ($this->session->userdata('admin_id') == 1 || in_array('menu/delete', $this->permission)) { ?>
                    <a class="btn btn-danger delete" alt="<?php echo $item->id; ?>" >
                        <i class="glyphicon glyphicon-trash icon-white"></i>
                        <?php echo $this->lang->line('Delete'); ?>
                    </a>
                    <?php } ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    <?php else: ?>
        <tr>
            <td>
                <?php echo $this->lang->line('No items to show.'); ?>
            </td>
        </tr>
    <?php endif; ?>
</table>

<script>
$('.delete').click(function() {
    var id = $(this).attr('alt');

    $.msgBox({
        title: '<?php echo $this->lang->line('Delete'); ?>', 
        content: '<?php echo $this->lang->line('Are you sure you want to delete language?'); ?>',
        type: "error",
        buttons: [{value: '<?php echo $this->lang->line('Yes'); ?>'}, {value: '<?php echo $this->lang->line('No'); ?>'}],
        success: function(result) {
            if (result == '<?php echo $this->lang->line('Yes'); ?>') {
                $.ajax({
					url: base_url + "ajax",
					dataType: 'json',
					type: 'post',
					data: { 'action': 'delete_menu', 'id': id },
					success: function(data){
						if(data.success == true)
                            $('#td' + id).fadeOut(2000, function(){
                                $(this).remove();
                            });
					}
				});
            }
            else if(result == '<?php echo $this->lang->line('No'); ?>') {
                
            }
        }
    });
});
</script>

