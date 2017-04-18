<?php if ($this->session->flashdata('message') == 'add_success'): ?>
    <div style="display: none">
        <button  class="btn btn-primary noty" data-noty-options="{&quot;text&quot;:&quot;<?php echo $this->lang->line('Page added successfully'); ?>&quot;,&quot;layout&quot;:&quot;topCenter&quot;,&quot;type&quot;:&quot;success&quot;}">
            <i class="glyphicon glyphicon-bell icon-white"></i> Top Center (fade)
        </button>
    </div>
<?php endif; ?>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2>
                    <i class="glyphicon glyphicon-list-alt"></i>
                    <?php echo $this->lang->line('Add'); ?>
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
                                <label class="control-label required" for="Page[url]" >URL</label>
                                <input name="Page[url]" value="<?php echo set_value('Page[url]'); ?>" type="text" class="form-control" id="url">
                                <div class="error"><?php echo form_error('Page[url]'); ?></div>
                            </td>
                        </tr>
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
                                            <input name="Page[title_<?php echo $language->code; ?>]" value="<?php echo set_value('Page[title_' . $language->code . ']'); ?>" type="text" class="form-control" id="title" <?php echo $is_default ? 'required="required"' : ''; ?>>
                                            <div class="error"><?php echo form_error('Page[title_' . $language->code . ']'); ?></div>

                                            <br />
                                            <label class="control-label" for="Page[meta_keywords_<?php echo $language->code; ?>]"><?php echo $this->lang->line('Meta keywords'); ?></label>
                                            <input name="Page[meta_keywords_<?php echo $language->code; ?>]" value="<?php echo set_value('Page[meta_keywords_' . $language->code . ']'); ?>" type="text" class="form-control" id="meta_keywords">
                                            <div class="error"><?php echo form_error('Page[meta_keywords_' . $language->code . ']'); ?></div>

                                            <br />
                                            <label class="control-label" for="Page[meta_description_<?php echo $language->code; ?>]"><?php echo $this->lang->line('Meta description'); ?></label>
                                            <input name="Page[meta_description_<?php echo $language->code; ?>]" value="<?php echo set_value('Page[meta_description_' . $language->code . ']'); ?>" type="text" class="form-control" id="meta_description">
                                            <div class="error"><?php echo form_error('Page[meta_description_' . $language->code . ']'); ?></div>

                                            <br />
                                            <label class="control-label" for="Page[short_description_<?php echo $language->code; ?>]"><?php echo $this->lang->line('Short description'); ?></label>
                                            <textarea name="Page[short_description_<?php echo $language->code; ?>]" class="form-control" id="short_description"><?php echo set_value('Page[short_description_' . $language->code . ']'); ?></textarea>
                                            <div class="error"><?php echo form_error('Page[short_description_' . $language->code . ']'); ?></div>

                                            <br />
                                            <label class="control-label" for="Page[text_<?php echo $language->code; ?>]"><?php echo $this->lang->line('Text'); ?></label>
                                            <?php editor("Page[text_" . $language->code . "]", 'page_text_' . $language->code, set_value('Page[text_' . $language->code . ']')); ?>
                                            <div class="error"><?php echo form_error('Page[text_' . $language->code . ']'); ?></div>

                                            <input name="Page[parent_id]" value="<?php echo set_value('Page[parent_id]', $parent_id); ?>" type="hidden" class="form-control" id="paren_id">

                                        </div>
                                    <?php } ?>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="upload_image_wrapper">
                                <label class="control-label" for="image" ><?php echo $this->lang->line('Chose image'); ?></label><br/>
                                <input name="image" value="<?php echo set_value('image'); ?>" class="form-control" type="file"  id="image">
                                <div><img src="<?php echo base_url('img/upload-icon.png'); ?>" alt="" id="upload_image"/></div>
                                <div class="error"><?php echo form_error('image'); ?></div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label class="control-label" for="Page[status]" ><?php echo $this->lang->line('Status'); ?></label>
                                <?php echo form_dropdown('Page[status]', $statuses, set_value('Page[status]'), 'id="page_status", class="form-control"'); ?>
                                <div class="error"><?php echo form_error('Page[status]'); ?></div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input class="btn btn-primary" type="submit" value="<?php echo $this->lang->line('Add'); ?>" />
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
        setTimeout(function() {
            $('.noty').trigger('click');
        }, 1000);
    });

    $(function() {
        $('#myTab a:last').tab('show');
    });

    $('#upload_image').click(function(event) {
        $('#image').trigger('click');
    });

    $('#image').bind("change", function(e) {
        readURL(this);
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $("#upload_image").attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

</script>