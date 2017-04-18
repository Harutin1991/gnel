<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2>
                    <i class="glyphicon glyphicon-list-alt"></i> 
                    <?php echo $this->lang->line('Options'); ?>
                </h2>
                <div class="box-icon">
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
                </div>
            </div>
            <div class="box-content">
                <table class="table table-striped table-bordered bootstrap-datatable responsive">
                    <?php if(count($options) > 0): ?>
                        <thead>
                            <tr>
                                <th>
                                  <?php echo $this->lang->line('Name'); ?>
                                </th>
                                <th>
                                  <?php echo $this->lang->line('Actions'); ?>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($options as $item): ?>
                                <tr id="td<?php echo $item->id; ?>">
                                    <td>
                                        <?php echo $item->name; ?>
                                    </td>
                                    <td>
                                        <a class="btn btn-info" href="<?php echo base_url("option/edit/" . $item->id); ?>" >
                                            <i class="glyphicon glyphicon-edit icon-white"></i>
                                            <?php echo $this->lang->line('Edit'); ?>
                                        </a>
                                        <a class="btn btn-danger delete" alt="<?php echo $item->id; ?>" >
                                            <i class="glyphicon glyphicon-trash icon-white"></i>
                                            <?php echo $this->lang->line('Delete'); ?>
                                        </a>
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
            </div>
        </div>
    </div>
</div>

<script>
$('.delete').click(function() {
    var id = $(this).attr('alt');

    $.msgBox({
        title: '<?php echo $this->lang->line('Delete'); ?>', 
        content: '<?php echo $this->lang->line('Are you sure you want to delete option?'); ?>',
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
					data: { 'action': 'delete_option', 'id': id },
					success: function(data){
						if(data.success == true)
                            console.log(data);
                            $('#td' + id).fadeOut(2000, function(){
                                $(this).remove();
                            });
					}
				});
            } else if(result == '<?php echo $this->lang->line('No'); ?>') {
            //    alert('Ոչ');
            }
        }
    });
});
</script>

