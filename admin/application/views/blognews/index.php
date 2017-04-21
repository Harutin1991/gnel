<h3><?php echo $this->lang->line('Blognews'); ?></h3>


<style>
    #sortable { list-style-type: none; margin: 0; padding: 0; width: 100%; }
    #sortable li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em;  }
</style>
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
            <div class="box-content">
                <table>
                    <tbody>
                    <?php if (!empty($blognews)) { ?>
                        <div>
                            <div class="box-content" id="blog">
                                <div>
                                    <ul id="sortable" class="ui-sortable">
                                        <?php foreach ($blognews as $item) { ?>
                                            <li class="ui-state-default ui-sortable-handle  blog" id="li<?php echo $item->id; ?>" item_id="<?php echo $item->id; ?>">
                                                <?php echo $item->title;  ?>

                                                <a class="delete" alt="<?php echo $item->id; ?>" >
                                                    <span url="<?php echo $item->id; ?>" item_title="<?php echo $item->title;  ?>" item_id="<?php echo $item->id; ?>" class="edit btn btn-mini btn-danger edit_menu_item">
														<i class="glyphicon glyphicon-trash icon-white"></i>
                                                        <?php  echo $this->lang->line('Delete'); ?>
													</span>
                                                </a>
                                                <a href="<?php echo base_url(); ?>blognews/edit/<?php echo $item->id; ?>">
													<span url="<?php echo $item->id; ?>" item_title="<?php echo $item->title;  ?>" item_id="<?php echo $item->id; ?>" class="edit btn btn-mini btn-info edit_menu_item">
														<i class="glyphicon glyphicon-edit icon-white"></i>
                                                        <?php  echo $this->lang->line('Edit'); ?>
													</span>
                                                </a>
                                                <?php if ($item->status == "1") { ?>
                                                    <span class="label-success label label-default" action="disable" id="<?php echo $item->id; ?>" status="change" title="<?php echo $this->lang->line('Press to ban'); ?>" style="cursor: pointer; float: right;" ><?php echo $this->lang->line('Active'); ?></span>
                                                <?php } else { ?>
                                                    <span class="label-default label label-danger"  action="enable" id="<?php echo $item->id; ?>" status="change" title="<?php echo $this->lang->line('Press to activate'); ?>" style="cursor: pointer; float: right;" ><?php echo $this->lang->line('Banned'); ?></span>
                                                <?php } ?>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                            <br />
                            <img style="position:absolute;left:30%;top:70px;display:none;" class="ajax_loader" src="img/ajax_loader.gif" />
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
    $(function() {
        $( "#sortable" ).sortable();
        $( "#sortable" ).disableSelection();
    });


    jQuery(document).ready(function($) {

        $('span[status="change"]').click(function() {
            var action = $(this).attr('action');
            var table = 'blognews';
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

        $('#save').click(function() {
            $('.ajax_loader').show();
            $('#save').hide();
            var items = [];
            $(".blog" ).each(function(key, index ) {
                items.push({
                    id: $( this ).attr('item_id'),
                    order:  key + 1
                });
            });
            $.ajax({
                url: base_url + "ajax",
                dataType: 'json',
                type: 'post',
                data: {'action': 'save_blog', 'items':items },
                success: function(data) {
                    $('.ajax_loader').hide();
                    $('#save').show();
                }
            });

        });

    });

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
                        data: {'action': 'delete_blog', 'id': id},
                        success: function(data) {
                            if (data.success == true)
                                $('#li' + id).fadeOut(2000, function() {
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


</script>