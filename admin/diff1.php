<div class="tab-pane" id="<?php echo $language->code; ?>">
    <br />
    <label class="control-label" for="Page[title_<?php echo $language->code; ?>]"><?php echo $this->lang->line('Title'); ?></label>
    <input name="Page[title_<?php echo $language->code; ?>]" value="<?php echo set_value('Page[title_' . $language->code . ']'); ?>" type="text" class="form-control" id="title">
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
    <label class="control-label" for="Page[text_<?php echo $language->code; ?>]"><?php echo $this->lang->line('Text'); ?></label>
    <?php editor("Page[text_" . $language->code . "]", 'page_text_' . $language->code, set_value('Page[text_' . $language->code . ']')); ?>
    <div class="error"><?php echo form_error('Page[text_' . $language->code . ']'); ?></div>

</div>