<?php if ($this->session->flashdata('message') == 'edit_success'): ?>
    <div style="display: none">
        <button  class="btn btn-primary noty" data-noty-options="{&quot;text&quot;:&quot;<?php echo $this->lang->line('Category edited successfully'); ?>&quot;,&quot;layout&quot;:&quot;topCenter&quot;,&quot;type&quot;:&quot;success&quot;}">
        </button>
    </div>
<?php elseif ($this->session->flashdata('message') == 'add_success'): ?>
    <div style="display: none">
        <button  class="btn btn-primary noty" data-noty-options="{&quot;text&quot;:&quot;<?php echo $this->lang->line('Category added successfully'); ?>&quot;,&quot;layout&quot;:&quot;topCenter&quot;,&quot;type&quot;:&quot;success&quot;}">
        </button>
    </div>
<?php endif; ?>

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
                <form method="POST" enctype="multipart/form-data">
                    <table>
                        <tbody>
                            <tr>
                                <td>
                                    <ul class="nav nav-tabs" id="myTab">
                                        <?php foreach ($languages as $language) { ?>
                                            <?php if ($language->code == $default_language) { ?>
                                                <li class="active">
                                                    <a href="#<?php echo $language->code; ?>"><?php echo $language->name; ?></a>
                                                </li>
                                            <?php } else { ?>
                                                <li>
                                                    <a href="#<?php echo $language->code; ?>"><?php echo $language->name; ?></a>
                                                </li>
                                            <?php } ?>
                                        <?php } ?>
                                    </ul>
                                    <div class="tab-content">
                                        <?php foreach ($languages as $language) { ?>
                                            <?php $is_default = $language->code == $default_language; ?>
                                            <div class="tab-pane <?php echo $is_default ? "active" : ""; ?>" id="<?php echo $language->code; ?>">
                                                <br />
                                                <label class="control-label <?php echo $is_default ? "required" : ""; ?>" for="Category[name_<?php echo $language->code; ?>]"><?php echo $this->lang->line('Title'); ?></label>
                                                <input name="Category[name_<?php echo $language->code; ?>]" value="<?php echo set_value('Category[name_' . $language->code . ']', $category['name_' . $language->code]); ?>" type="text" class="form-control" id="title">
                                                <div class="error"><?php echo form_error('Category[name_' . $language->code . ']'); ?></div>

                                                <br />
                                                <label class="control-label" for="Category[meta_keywords_<?php echo $language->code; ?>]"><?php echo $this->lang->line('Meta keywords'); ?></label>
                                                <input name="Category[meta_keywords_<?php echo $language->code; ?>]" value="<?php echo set_value('Category[meta_keywords_' . $language->code . ']', $category['meta_keywords_' . $language->code]); ?>" type="text" class="form-control" id="meta_keywords">
                                                <div class="error"><?php echo form_error('Category[meta_keywords_' . $language->code . ']'); ?></div>

                                                <br />
                                                <label class="control-label" for="Category[meta_description_<?php echo $language->code; ?>]"><?php echo $this->lang->line('Meta description'); ?></label>
                                                <input name="Category[meta_description_<?php echo $language->code; ?>]" value="<?php echo set_value('Category[meta_description_' . $language->code . ']', $category['meta_description_' . $language->code]); ?>" type="text" class="form-control" id="meta_description">
                                                <div class="error"><?php echo form_error('Category[meta_description_' . $language->code . ']'); ?></div>

                                                <br />
                                                <label class="control-label" for="Category[description_<?php echo $language->code; ?>]"><?php echo $this->lang->line('Text'); ?></label>
                                                <?php editor("Category[description_" . $language->code . "]", 'category_text_' . $language->code, set_value('Category[description_' . $language->code . ']', $category['description_' . $language->code])); ?>
                                                <div class="error"><?php echo form_error('Category[description_' . $language->code . ']'); ?></div>

                                            </div>
                                        <?php } ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="image-box">
                                        <label class="control-label" for="image" ><?php echo $this->lang->line('Image'); ?></label>
                                        <input name="image" value="<?php echo set_value('image'); ?>" type="file" class="form-control" id="image">
                                        <div class="error"><?php echo form_error('image'); ?></div>
                                        <div>
                                            <img id="current-image" src="<?php echo $category['image'] !=="" ? $this->config->item('frontend_url') . 'images/category/' . $category['image'] : base_url('img/upload-icon.png'); ?>" width="100" title="<?php echo $this->lang->line('Change image'); ?>" />
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <!--
                            <tr>
                                <td>
                                    <label class="control-label" for="Category[status]" ><?php// echo $this->lang->line('Status'); ?></label>
                                    <?php //echo form_dropdown('Category[status]', $statuses, set_value('Category[status]', $category['status']), 'id="category_status", class="form-control"'); ?>
                                    <div class="error"><?php //echo form_error('Category[status]'); ?></div>
                                </td>
                            </tr>
                            -->
                            <tr>
                                <td>
                                    <label class="control-label" for="Category[options]" ><?php echo $this->lang->line('Options'); ?></label>
                                    <?php
                                    foreach ($options as $option_id => $option) {
                                        $post = $this->input->post('Category');
                                        $checked = "";
                                        if (isset($_POST['Category'])) {
                                            if (isset($post['option'][$option->id])) {
                                                $checked = "checked";
                                            } else {
                                                $checked = "";
                                            }
                                        } else {
                                            if (isset($category_options[$option->id])) {
                                                $checked = "checked";
                                                $post['option'] = array($option->id => $option->id);
                                                foreach ($languages as $language) {
                                                    $_POST['option_value_' . $option->id . '_' . $language->code] = $category_options[$option->id][$language->code];
                                                }
                                            }
                                        }
                                        ?>
                                        <div class="checkbox">
                                            <label>
                                                <input name="Category[option][<?php echo $option->id; ?>]" id="<?php echo $option->id; ?>" type="checkbox" <?php echo $checked; ?> value="<?php echo $option->id; ?>" class="option">
                                                <?php echo $option->name; ?>
                                            </label>
                                            <button id="<?php echo $option->id; ?>" class="add-values btn btn-xs" style="display: none">
                                                <?php echo $this->lang->line('Add values'); ?>
                                            </button>
                                        </div>
                                        <div id="div<?php echo $option->id; ?>" title="<?php echo $option->id; ?>">
                                            <?php if (isset($post['option'][$option->id])) { ?>
                                                <?php if (isset($_POST['option_value_' . $option->id . '_' . $default_language])) { ?>
                                                    <?php foreach ($_POST['option_value_' . $option->id . '_' . $default_language] as $option_value_key => $option_value_t) { ?>
                                                        <div class="option-value">
                                                            <i class="glyphicon glyphicon-remove"></i>
                                                            <ul class="nav nav-tabs" id="Tab">
                                                                <?php foreach ($languages as $language) { //:  ?>
                                                                    <?php if ($language->code == $default_language) { //:  ?>
                                                                        <li class="active">
                                                                            <a href="#lang_<?php echo $language->code; ?>"><?php echo $language->name; ?></a>
                                                                        </li>
                                                                    <?php } else { //:  ?>
                                                                        <li>
                                                                            <a href="#lang_<?php echo $language->code; ?>"><?php echo $language->name; ?></a>
                                                                        </li>
                                                                    <?php } //endif;  ?>
                                                                <?php } //endforeach;  ?>
                                                            </ul>
                                                            <div class="tab-content">
                                                                <br />
                                                                <?php foreach ($languages as $language) { ?>
                                                                    <?php if ($language->code == $default_language) { ?>
                                                                        <div class="tab-pane active" id="lang_<?php echo $language->code; ?>">
                                                                            <label class="control-label required" for="Category[option_<?php echo $language->code; ?>]"><?php echo $this->lang->line('Option'); ?></label>
                                                                            <input name="<?php echo 'option_value_' . $option->id . '_' . $language->code; ?>[]" value="<?php echo $_POST['option_value_' . $option->id . '_' . $language->code][$option_value_key]; ?>" type="text" class="form-control" id="option" title="<?php echo $language->code; ?>">
                                                                        </div>
                                                                    <?php } else { ?>
                                                                        <div class="tab-pane" id="lang_<?php echo $language->code; ?>">
                                                                            <label class="control-label" for="Category[option_<?php echo $language->code; ?>]"><?php echo $this->lang->line('Option'); ?></label>
                                                                            <input name="<?php echo 'option_value_' . $option->id . '_' . $language->code; ?>[]" value="<?php echo $_POST['option_value_' . $option->id . '_' . $language->code][$option_value_key]; ?>" type="text" class="form-control" id="option" title="<?php echo $language->code; ?>">
                                                                        </div>
                                                                    <?php } //endif;  ?>
                                                                <?php } //endforeach;  ?>
                                                            </div>
                                                        </div>
                                                    <?php } //end foreach  ?>
                                                <?php } //end if  ?>
                                            <?php } //end if ?>
                                        </div>
                                    <?php } //endforeach; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input class="btn btn-primary" type="submit" value="<?php echo $this->lang->line('Edit'); ?>" />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="hidden-div" style="display: none;">
    <div class="option-value">
        <i class="glyphicon glyphicon-remove"></i>
        <ul class="nav nav-tabs" id="Tab">
            <?php foreach ($languages as $language) { //:  ?>
                <?php if ($language->code == $default_language) { //:  ?>
                    <li class="active">
                        <a href="#lang_<?php echo $language->code; ?>"><?php echo $language->name; ?></a>
                    </li>
                <?php } else { //:  ?>
                    <li>
                        <a href="#lang_<?php echo $language->code; ?>"><?php echo $language->name; ?></a>
                    </li>
                <?php } //endif;  ?>
            <?php } //endforeach;  ?>
        </ul>
        <div class="tab-content">
            <br />
            <?php foreach ($languages as $language) { //:  ?>
                <?php if ($language->code == $default_language) { //:  ?>
                    <div class="tab-pane active" id="lang_<?php echo $language->code; ?>">
                        <label class="control-label required" for="Category[option_<?php echo $language->code; ?>]"><?php echo $this->lang->line('Option'); ?></label>
                        <input name="value_<?php echo $language->code; ?>" value="" type="text" class="form-control" id="option" title="<?php echo $language->code; ?>">
                    </div>
                <?php } else { //:  ?>
                    <div class="tab-pane" id="lang_<?php echo $language->code; ?>">
                        <label class="control-label" for="Category[option_<?php echo $language->code; ?>]"><?php echo $this->lang->line('Option'); ?></label>
                        <input name="value_<?php echo $language->code; ?>" value="" type="text" class="form-control" id="option" title="<?php echo $language->code; ?>">
                    </div>
                <?php } //endif;  ?>
            <?php } //endforeach;  ?>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        $('.option').each(function() {
            if ($(this).is(':checked')) {
                $(this).closest('div').children('.add-values').show();
            }
            else {
                $(this).closest('div').children('.add-values').hide();
            }
        });

        $('.option').change(function() {
            id = $(this).val();
            if ($(this).is(':checked')) {
                $(this).closest('div').children('.add-values').show();
                $('#div' + id).show();
            }
            else {
                $(this).closest('div').children('.add-values').hide();
                $('#div' + id).hide();
            }
        });

        $(document).on('click', '.option-value i.glyphicon-remove', function() {
            $(this).parent().remove();
        });

        $(document).on('click', '#Tab a', function(e) {
            e.preventDefault();
            id = $(this).attr('href');

            $(this).parent().parent().children('li.active').removeClass('active');
            $(this).parent().addClass('active');

            $(this).closest('div').children('div').children('div.active').removeClass('active');
            $(this).closest('div').children('div').children('div' + id).addClass('active');

        });

        $('#image').css('display', 'none');
        $('#img-div').css('display', 'block');
        $('#current-image').click(function() {
            $('#image').click();
        });

        $('.add-values').click(function(e) {
            e.preventDefault();

            var id = $(this).attr('id');
            var div = $("#hidden-div .option-value").clone().prependTo('#div' + id);

            div.find('input').each(function() {
                lang = $(this).attr('title');
                $(this).attr('name', 'option_value_' + id + '_' + lang + '[]');
            });

        });
    });
</script>

