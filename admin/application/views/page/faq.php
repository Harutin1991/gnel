<?php if ($this->session->flashdata('message') == 'edit_success'): ?>
    <div style="display: none">
        <button  class="btn btn-primary noty" data-noty-options="{&quot;text&quot;:&quot;<?php echo $this->lang->line('Menu has edited successfully'); ?>&quot;,&quot;layout&quot;:&quot;topCenter&quot;,&quot;type&quot;:&quot;success&quot;}">
            <i class="glyphicon glyphicon-bell icon-white"></i> Top Center (fade)
        </button>
    </div>
<?php endif; ?>


    <div class="row">
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-question="">
                    <h2>
                        <i class="glyphicon glyphicon-list-alt"></i>
                        <?php echo $this->lang->line('faq'); ?>
                    </h2>
                    <div class="box-icon">
                        <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    <!--                    <h3 style="margin: 20px">--><?php // echo $this->lang->line('sections'); ?><!--</h3>-->
                    <!--                    <hr>-->
                    <div class="pull-right">
                        <a class="btn btn-success" href="<?php echo base_url("page/addfaq/"); ?>" >
                            <i class="glyphicon glyphicon-plus icon-white"></i>
                            <?php echo $this->lang->line('add_a_question'); ?>
                        </a>
                    </div>
                    <div class="clear"></div><br>
                    <?php if (!empty($faqs)) { ?>
                        <table>
                            <tbody>
                            <div>
                                <div class="box-content" id="faq">
                                    <div>
                                        <ul id="sortable" class="ui-sortable">
                                            <?php foreach ($faqs as $item) { ?>
                                                <li class="ui-state-default ui-sortable-handle  faq" id="li<?php echo $item['id']; ?>" item_id="<?php echo $item['id']; ?>">
                                                    <?php echo $item['question'];  ?>

                                                    <a class="delete" alt="<?php echo $item['id']; ?>" >
                                                            <span url="<?php echo $item['id']; ?>" item_question="<?php echo $item['question'];  ?>" item_id="<?php echo $item['id']; ?>" class="edit btn btn-mini btn-danger edit_menu_item">
                                                                <i class="glyphicon glyphicon-trash icon-white"></i>
                                                                <?php  echo $this->lang->line('Delete'); ?>
                                                            </span>
                                                    </a>
                                                    <a href="<?php echo base_url(); ?>page/editfaq/<?php echo $item['id']; ?>">
                                                            <span url="<?php echo $item['id']; ?>" item_question="<?php echo $item['question'];  ?>" item_id="<?php echo $item['id']; ?>" class="edit btn btn-mini btn-info edit_menu_item">
                                                                <i class="glyphicon glyphicon-edit icon-white"></i>
                                                                <?php  echo $this->lang->line('Edit'); ?>
                                                            </span>
                                                    </a>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                                <br />
                                <img style="position:absolute;left:30%;top:70px;display:none;" class="ajax_loader" src="/img/ajax_loader.gif" />
                                <span id="save" class="btn btn-primary"><?php echo $this->lang->line('Save order'); ?></span>
                            </div>
                            </tbody>
                        </table>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>


<script>
    $(document).ready(function() {

        $(function() {
            $( "#sortable" ).sortable();
            $( "#sortable" ).disableSelection();
        });

        $('#save').click(function() {
            $('.ajax_loader').show();
            $('#save').hide();
            var items = [];
            $(".faq" ).each(function(key, index ) {
                items.push({
                    id: $( this ).attr('item_id'),
                    order:  key + 1
                });
            });
            console.log(items);
            $.ajax({
                url: base_url + "ajax",
                dataType: 'json',
                type: 'post',
                data: {'action': 'save_faq', 'items':items },
                success: function(data) {
                    $('.ajax_loader').hide();
                    $('#save').show();
                }
            });

        });

    });


    $('.delete').click(function() {
        var id = $(this).attr('alt');
        console.log(id);

        $.msgBox({
            question: '<?php echo $this->lang->line('Delete'); ?>',
            content: '<?php echo $this->lang->line('Are you sure you want to delete language?'); ?>',
            type: "error",
            buttons: [{value: '<?php echo $this->lang->line('Yes'); ?>'}, {value: '<?php echo $this->lang->line('No'); ?>'}],
            success: function(result) {
                if (result == '<?php echo $this->lang->line('Yes'); ?>') {
                    $.ajax({
                        url: base_url + "ajax",
                        dataType: 'json',
                        type: 'post',
                        data: {'action': 'delete_faq', 'id': id},
                        success: function(data) {
                            if (data.success == true)
                                $('#li' + id).fadeOut(2000, function() {
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

</script>