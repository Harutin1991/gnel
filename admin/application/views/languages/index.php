ՙ<h3><?php echo $this->lang->line('Languages'); ?></h3>

<table class="table table-striped table-bordered bootstrap-datatable responsive">
    <thead>
        <tr>
            <th>
                <?php echo $this->lang->line('Code'); ?>
            </th>
            <th>
                <?php echo $this->lang->line('Name'); ?>
            </th>
            <th>
                <?php echo $this->lang->line('Status'); ?>
            </th>
            <th style="width:300px;">
                <?php echo $this->lang->line('Actions'); ?>
            </th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($languages as $language): ?>
            <tr id="td<?php echo $language->id; ?>">
                <td>
                    <?php echo $language->code; ?>
                </td>
                <td>
                    <?php echo $language->name; ?>
                </td>
                <td>
                    <?php if ($language->status == "enabled") { ?>
                        <span class="label-success label label-default" action="disable_language" id="<?php echo $language->id; ?>" status="change" title="<?php echo $this->lang->line('Press to ban'); ?>" style="cursor: pointer;"><?php echo $this->lang->line('Active'); ?></span>
                    <?php } else { ?>
                        <span class="label-default label label-danger"  action="enable_language" id="<?php echo $language->id; ?>" status="change" title="<?php echo $this->lang->line('Press to activate'); ?>" style="cursor: pointer;"><?php echo $this->lang->line('Banned'); ?></span>
                    <?php } ?>
                </td>
                <td>
                    <?php if ($this->session->userdata('admin_id') == 1 || in_array('languages/edit', $this->permission)) { ?>
                        <a class="btn btn-info" href="<?php echo base_url("languages/edit/" . $language->id); ?>" >
                            <i class="glyphicon glyphicon-edit icon-white"></i>
                            <?php echo $this->lang->line('Edit'); ?>
                        </a>
                    <?php } ?>
                    <?php if ($this->session->userdata('admin_id') == 1 || in_array('languages/delete', $this->permission)) { ?>
                        <a class="btn btn-danger delete" alt="<?php echo $language->id; ?>" >
                            <i class="glyphicon glyphicon-trash icon-white"></i>
                            <?php echo $this->lang->line('Delete'); ?>
                        </a>
                    <?php } ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
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
                        data: {'action': 'delete_language', 'id': id},
                        success: function(data) {
                            if (data.success == true)
                                $('#td' + id).fadeOut(2000, function() {
                                    $(this).remove();
                                });
                        }
                    });
                }
                else if (result == '<?php echo $this->lang->line('No'); ?>') {
                    //    alert('Ոչ');
                }
            }
        });
    });
    $('span[status="change"]').click(function() {
        var action = $(this).attr('action');
        var id = $(this).attr('id');
        $.ajax({
            url: base_url + "ajax",
            dataType: 'json',
            type: 'post',
            data: {'action': action, 'id': id},
            success: function(data) {
                location.reload();
            }
        });
    });
</script>

