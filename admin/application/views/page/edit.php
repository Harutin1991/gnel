<?php if ($this->session->flashdata('message') == 'edit_success'): ?>
    <div style="display: none">
        <button  class="btn btn-primary noty" data-noty-options="{&quot;text&quot;:&quot;<?php echo $this->lang->line('Menu has edited successfully'); ?>&quot;,&quot;layout&quot;:&quot;topCenter&quot;,&quot;type&quot;:&quot;success&quot;}">
            <i class="glyphicon glyphicon-bell icon-white"></i> Top Center (fade)
        </button>
    </div>
<?php endif; ?>

<?php if (isset($page['parent_id']) && !$page['parent_id']) {  ?>
    <div class="row">
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2>
                        <i class="glyphicon glyphicon-list-alt"></i>
                        <?php echo $this->lang->line('sections'); ?>
                    </h2>
                    <div class="box-icon">
                        <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
                    </div>
                </div>
                <div class="box-content">

                    <div class="pull-right">
                        <a class="btn btn-success" href="<?php echo base_url("page/add/" . $page['id']); ?>" >
                            <i class="glyphicon glyphicon-plus icon-white"></i>
                            <?php echo $this->lang->line('Create sub page'); ?>
                        </a>
                    </div>
                    <div class="clear"></div><br>
					<?php if (!empty($pages)) {  ?>
                    <table>
                        <tbody>
                            <div>
                                <div class="box-content" id="blog">
                                    <div>
                                        <ul id="sortable" class="ui-sortable">
                                            <?php foreach ($pages as $item) { ?>
                                                <li class="ui-state-default ui-sortable-handle  blog" id="li<?php echo $item['id']; ?>" item_id="<?php echo $item['id']; ?>">
                                                    <?php echo $item['title'];  ?>

                                                    <a class="delete" alt="<?php echo $item['id']; ?>" >
                                                        <span url="<?php echo $item['id']; ?>" item_title="<?php echo $item['title'];  ?>" item_id="<?php echo $item['id']; ?>" class="edit btn btn-mini btn-danger edit_menu_item">
                                                            <i class="glyphicon glyphicon-trash icon-white"></i>
                                                            <?php  echo $this->lang->line('Delete'); ?>
                                                        </span>
                                                    </a>
                                                    <a href="<?php echo base_url(); ?>page/edit/<?php echo $item['id']; ?>">
                                                        <span url="<?php echo $item['id']; ?>" item_title="<?php echo $item['title'];  ?>" item_id="<?php echo $item['id']; ?>" class="edit btn btn-mini btn-info edit_menu_item">
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
<?php } ?>



<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2>
                    <i class="glyphicon glyphicon-list-alt"></i>
                    <?php echo $this->lang->line('Edit'); ?>
                </h2>
                <div class="box-icon">
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
                </div>
            </div>
            <div class="box-content">
                <?php if (empty($pages)) {?>
                    <div class="pull-right">
                        <a class="btn btn-default" href="<?php echo base_url("page/edit/" . $page['parent_id']); ?>" >
                            <i class="glyphicon glyphicon-arrow-left icon-white"></i>
                            <?php echo $this->lang->line('back'); ?>
                        </a>
                    </div>
                    <div class="clear"></div>
                    <hr>
                <?php } ?>
<!--                <h3 style="margin: 20px">--><?php // echo $this->lang->line('Edit'); ?><!--</h3>-->
<!--                <hr>-->
                <table>
                    <form method="POST" enctype="multipart/form-data">
                        <tbody>

                            <tr>
                                <td>
                                    <ul class="nav nav-tabs" id="myTab">
                                        <?php foreach ($languages as $language) { ?>
                                            <?php $is_default = $language->code == $default_language; ?>
                                            <li class="<?php echo $is_default ? 'active' : ''; ?>">
                                                <a href="#<?php echo $language->code; ?>"><?php echo $language->name; ?></a>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                    <div class="tab-content">
                                        <?php foreach ($languages as $language) { ?>
                                            <?php $is_default = $language->code == $default_language; ?>
                                            <div class="tab-pane <?php echo $is_default ? 'active' : ''; ?>" id="<?php echo $language->code; ?>">
                                                <br />
                                                <label class="control-label <?php echo $is_default ? 'required' : ''; ?>" for="Page[title_<?php echo $language->code; ?>]"><?php echo $this->lang->line('Title'); ?></label>
                                                <input name="Page[title_<?php echo $language->code; ?>]" value="<?php echo set_value('Page[title_' . $language->code . ']', $page['title_' . $language->code]); ?>" type="text" class="form-control" id="title" <?php echo $is_default ? 'required="required"' : ''; ?>>
                                                <div class="error"><?php echo form_error('Page[title_' . $language->code . ']'); ?></div>

                                                <br />
                                                <label class="control-label" for="Page[meta_description_<?php echo $language->code; ?>]"><?php echo $this->lang->line('Meta description'); ?></label>
                                                <input name="Page[meta_description_<?php echo $language->code; ?>]" value="<?php echo set_value('Page[meta_description_' . $language->code . ']', $page['meta_description_' . $language->code]); ?>" type="text" class="form-control" id="meta_description">
                                                <div class="error"><?php echo form_error('Page[meta_description_' . $language->code . ']'); ?></div>

                                                <br />
                                                <label class="control-label" for="Page[short_description_<?php echo $language->code; ?>]"><?php echo $this->lang->line('short description'); ?></label>
<!--                                                <textarea name="Page[short_description_--><?php //echo $language->code; ?><!--]"  class="form-control" id="short_description">--><?php //echo set_value('Page[short_description_' . $language->code . ']', $page['short_description_' . $language->code]); ?><!-- </textarea>-->
                                                <input name="Page[short_description_<?php echo $language->code; ?>]" value="<?php echo set_value('Page[short_description_' . $language->code . ']', $page['short_description_' . $language->code]); ?>" type="text" class="form-control" id="short_description_">
                                                <div class="error"><?php echo form_error('Page[short_description_' . $language->code . ']'); ?></div>

                                                <br />
                                                <label class="control-label" for="Page[text_<?php echo $language->code; ?>]"><?php echo $this->lang->line('Text'); ?></label>
                                                <?php editor("Page[text_" . $language->code . "]", 'page_text_' . $language->code, set_value('Page[text_' . $language->code . ']', $page['text_' . $language->code])); ?>
                                                <div class="error"><?php echo form_error('Page[text_' . $language->code . ']'); ?></div>

                                            </div>
                                        <?php } ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="upload_image_wrapper">
                                    <?php $img_url = $page['image'] != '' ? $this->config->item('frontend_url') . 'images/pages/' . $page['image'] : base_url('img/upload-icon.png'); ?>
                                    <label class="control-label" for="image" ><?php echo $this->lang->line('Chose image'); ?></label><br/>
                                    <input name="image" value="<?php echo set_value('image'); ?>" class="form-control" type="file"  id="image">
                                    <div><img src="<?php echo $img_url; ?>" alt="" id="current-image"/></div>
                                    <div class="error"><?php echo form_error('image'); ?></div>
                                </td>
                            </tr>
<!--                            <tr>-->
<!--                                <td>-->
<!--                                    <div class="image-box">-->
<!--                                        <label class="control-label" for="image" >--><?php //echo $this->lang->line('Image'); ?><!--</label>-->
<!--                                        <input name="image" value="--><?php //echo set_value('image'); ?><!--" type="file" class="form-control" id="image">-->
<!--                                        <div class="error">--><?php //echo form_error('image'); ?><!--</div>-->
<!--                                        <div>-->
<!--                                            <img id="current-image" src="--><?php //echo $this->config->item('frontend_url') . 'images/pages/' . $page['image']; ?><!--" width="100" title="--><?php //echo $this->lang->line('Change image'); ?><!--" />-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </td>-->
<!--                            </tr>-->

                            <tr>
                                <td>
                                    <input class="btn btn-primary" type="submit" value="<?php echo $this->lang->line('Edit'); ?>" />
                                </td>
                            </tr>
                        </tbody>
                    </form>
                </table>
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
            $(".blog" ).each(function(key, index ) {
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
                data: {'action': 'save_sub_page', 'items':items },
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
                        data: {'action': 'delete_sub_page', 'id': id},
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



        $('#image').bind("change", function(e) {
            readURL(this);
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $("#current-image").attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }



    $(function() {
        $('#myTab a:last').tab('show');
    });
</script>