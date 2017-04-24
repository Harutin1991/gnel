<?php if ($this->session->flashdata('message') == 'edit_success'): ?>
    <div style="display: none">
        <button  class="btn btn-primary noty" data-noty-options="{&quot;content&quot;:&quot;<?php echo $this->lang->line('Menu has edited successfully'); ?>&quot;,&quot;layout&quot;:&quot;topCenter&quot;,&quot;type&quot;:&quot;success&quot;}">
            <i class="glyphicon glyphicon-bell icon-white"></i> Top Center (fade)
        </button>
    </div>
<?php endif; ?>
<h3><?php echo $this->lang->line('contact'); ?></h3>
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
                    <a class="btn btn-success" href="<?php echo base_url("page/addcontact/"); ?>" >
                        <i class="glyphicon glyphicon-plus icon-white"></i>
                        <?php echo $this->lang->line('add_topic'); ?>
                    </a>
                </div>
                <div class="clear"></div><br>
                <?php if (!empty($contacts_topic)) { ?>
                <table>
                    <tbody>
                    <div>
                        <div class="box-content" id="blog">
                            <div>
                                <ul id="sortable" class="ui-sortable">
                                    <?php foreach ($contacts_topic as $item) { ?>
                                        <li class="ui-state-default ui-sortable-handle  blog" id="li<?php echo $item['id']; ?>" item_id="<?php echo $item['id']; ?>">
                                            <?php echo $item['title'];  ?>

                                            <a class="delete" alt="<?php echo $item['id']; ?>" >
                                                    <span url="<?php echo $item['id']; ?>" item_title="<?php echo $item['title'];  ?>" item_id="<?php echo $item['id']; ?>" class="edit btn btn-mini btn-danger edit_menu_item">
                                                        <i class="glyphicon glyphicon-trash icon-white"></i>
                                                        <?php  echo $this->lang->line('Delete'); ?>
                                                    </span>
                                            </a>
                                            <a href="<?php echo base_url(); ?>page/editcontact/<?php echo $item['id']; ?>">
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
                                            <label class="control-label" for="Contact[content_<?php echo $language->code; ?>]"><?php echo $this->lang->line('content'); ?></label>
                                            <?php editor("Contact[content_" . $language->code . "]", 'Contact[content_' . $language->code, set_value('Contact[content_' . $language->code . ']', $contacts['content_' . $language->code] ? $contacts['content_' . $language->code] : '')); ?>
                                            <div class="error"><?php echo form_error('Contact[content_' . $language->code . ']'); ?></div>

                                        </div>
                                    <?php } ?>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="upload_image_wrapper">
                                <?php $img_url = $contacts['image'] != '' ? $this->config->item('frontend_url') . 'images/contact/' . $contacts['image'] : base_url('img/upload-icon.png'); ?>
                                <label class="control-label" for="image" ><?php echo $this->lang->line('Chose image'); ?></label><br/>
                                <input name="image" value="<?php echo set_value('image'); ?>" class="form-control" type="file"  id="image">
                                <div><img src="<?php echo $img_url; ?>" alt="" id="current-image"/></div>
                                <div class="error"><?php echo form_error('image'); ?></div>
                            </td>
                        </tr>
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
            $.ajax({
                url: base_url + "ajax",
                dataType: 'json',
                type: 'post',
                data: {'action': 'save_contact_topic', 'items':items },
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
                        data: {'action': 'delete_contact_topic', 'id': id},
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