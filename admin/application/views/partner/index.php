<h3><?php echo $this->lang->line('Partners'); ?></h3>

<table class="table table-striped table-bordered bootstrap-datatable responsive">
    <?php if (count($partners) > 0) { ?>
        <thead>
            <tr>
                <th style="width:10%;">
                    <?php echo $this->lang->line('Image'); ?>
                </th>
                <th>
                    <?php echo $this->lang->line('Name'); ?>
                </th>
                <th class="center">
                    <?php echo $this->lang->line('Status'); ?>
                </th>
                <th style="width:30%;" class="center">
                    <?php echo $this->lang->line('Actions'); ?>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($partners) > 0) { ?>
                <?php foreach ($partners as $item) { ?>
				
                    <tr id="td<?php echo $item->id; ?>">
                        <td class="image-in-list">
                            <?php $img_url = $item->image != '' ? $this->config->item('frontend_url') . 'images/partner/' . $item->image : base_url('img/NoPicture.jpg'); ?>
                            <img src="<?php echo $img_url; ?>"/>
                        </td>
                        <td>
                            <?php echo $item->name; ?>
                        </td>
                        <td class="center">
                            <?php // echo $item->status; ?>
                            <?php if ($item->status == "1") { ?>
                                <span class="label-success label label-default" action="disable" id="<?php echo $item->id; ?>" status="change" title="<?php echo $this->lang->line('Press to ban'); ?>" style="cursor: pointer;"><?php echo $this->lang->line('Active'); ?></span>
                            <?php } else { ?>
                                <span class="label-default label label-danger"  action="enable" id="<?php echo $item->id; ?>" status="change" title="<?php echo $this->lang->line('Press to activate'); ?>" style="cursor: pointer;"><?php echo $this->lang->line('Banned'); ?></span>
                            <?php } ?>
                        </td>
                        <td class="center">
                            <a class="btn btn-info" href="<?php echo base_url("partner/edit/" . $item->id); ?>" >
                                <i class="glyphicon glyphicon-edit icon-white"></i>
                                <?php // echo $this->lang->line('Edit'); ?>
                            </a>
<!--                            <a class="btn btn-danger delete" alt="<?php echo $item->id; ?>" >
                                <i class="glyphicon glyphicon-trash icon-white"></i>
                                <?php // echo $this->lang->line('Delete'); ?>
                            </a>-->
                        </td>
                    </tr>
                <?php } ?>
            <?php } ?>
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
    jQuery(document).ready(function($) {

        $('span[status="change"]').click(function() {
            var action = $(this).attr('action');
            var table = 'partners';
            var id = $(this).attr('id');
            $.ajax({
                url: base_url + "ajax",
                dataType: 'json',
                type: 'post',
                data: {'action': action, 'table':table, 'id': id, },
                success: function(data) {
                    location.reload();
                }
            });
        });

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
                            data: {'action': 'delete_partner', 'id': id},
                            success: function(data) {
                                if (data.success == true)
                                    $('#td' + id).fadeOut(2000, function() {
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
