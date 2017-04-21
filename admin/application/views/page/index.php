ՙ<h3><?php echo $this->lang->line('Pages'); ?></h3>

<table class="table table-striped table-bordered bootstrap-datatable responsive">

    <?php if(!empty($pages)) { ?>
        <thead>
            <tr>
                <th>
                  <?php echo $this->lang->line('Name'); ?>
                </th>
                <th style="width:65%;">
                  <?php echo $this->lang->line('Actions'); ?>
                </th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($pages as $item): ?>
            <?php if($item->parent_id == 0) { ?>
                <tr id="td<?php echo $item->id; ?>">
                    <td>
                        <?php echo $item->title; ?>
                    </td>
                    <td class="page_table_2td">
                        <a class="btn btn-success" href="<?php echo base_url("page/addSubPage/" . $item->id); ?>" >
                            <i class="glyphicon glyphicon-plus icon-white"></i>
                            <?php echo $this->lang->line('Create sub page'); ?>
                        </a>
                        <a class="btn btn-primary" href="<?php echo base_url("page/subPages/" . $item->id); ?>" >
                            <i class="glyphicon glyphicon-chevron-down icon-white"></i>
                            <?php echo $this->lang->line('Show sub pages'); ?>
                        </a>
                        <a class="btn btn-info" href="<?php echo base_url("page/edit/" . $item->id); ?>" >
                            <i class="glyphicon glyphicon-edit icon-white"></i>
                            <?php echo $this->lang->line('Edit'); ?>
                        </a>
                        <a class="btn btn-danger delete" alt="<?php echo $item->id; ?>" >
                            <i class="glyphicon glyphicon-trash icon-white"></i>
                            <?php echo $this->lang->line('Delete'); ?>
                        </a>
                    </td>
                </tr>
            <?php } ?>
        <?php endforeach; ?>
    </tbody>
    <?php } else { ?>
        <tr>
            <td>
                <?php echo $this->lang->line('No items to show.'); ?>
            </td>
        </tr>
    <?php } ?>
</table>

<script>
$('.delete').click(function() {
    var id = $(this).attr('alt');

    $.msgBox({
        title: '<?php echo $this->lang->line('Delete'); ?>', 
        content: '<?php echo $this->lang->line('Are you sure you want to delete page?'); ?>',
        type: "error",
        buttons: [{value: '<?php echo $this->lang->line('Yes'); ?>'}, {value: '<?php echo $this->lang->line('No'); ?>'}],
        success: function(result) {
            if (result == '<?php echo $this->lang->line('Yes'); ?>') {
                $.ajax({
					url: base_url + "ajax",
					dataType: 'json',
					type: 'post',
					data: { 'action': 'delete_page', 'id': id },
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
