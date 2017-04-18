<?php if ($this->session->flashdata('message') == 'edit_success'): ?>
    <div style="display: none">
        <button  class="btn btn-primary noty" data-noty-options="{&quot;text&quot;:&quot;<?php echo $this->lang->line('Blog has updated successfully'); ?>&quot;,&quot;layout&quot;:&quot;topCenter&quot;,&quot;type&quot;:&quot;success&quot;}">
            <i class="glyphicon glyphicon-bell icon-white"></i> Top Center (fade)
        </button>
    </div>
<?php endif; ?>


<?php // echo "<pre>"; var_dump($blognews); echo "</pre>"; ?>
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
                                    <?php if (count($languages) > 1) { ?>
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
                                    <?php } ?>
                                    <div class="tab-content">
                                        <?php foreach ($languages as $language) { ?>
                                            <?php $is_default = $language->code == $default_language; ?>
                                            <div class="tab-pane <?php echo $is_default ? "active" : ""; ?>" id="<?php echo $language->code; ?>">
                                                <br />
                                                <label class="control-label <?php echo $is_default ? "required" : ""; ?>" for="Blogcategories[title_<?php echo $language->code; ?>]"><?php echo $this->lang->line('Title'); ?></label>
                                                <input name="Blogcategories[title_<?php echo $language->code; ?>]" value="<?php echo set_value('Blogcategories[title_' . $language->code . ']', $blogcategories['title_'.$language->code]); ?>" type="text" class="form-control" id="Blogcategories[title_<?php echo $language->code; ?>]" <?php echo $is_default ? "required='required'" : ""; ?>>
                                                <div class="error"><?php echo form_error('Blogcategories[title_' . $language->code . ']'); ?></div>

                                               
                                                <br />
                                                <label class="control-label" for="Blogcategories[content_<?php echo $language->code; ?>]"><?php echo $this->lang->line('Content'); ?></label>
                                                <?php editor("Blogcategories[content_" . $language->code . "]", 'band_content_' . $language->code, set_value('Blogcategories[content_' . $language->code . ']', $blogcategories['content_'.$language->code])); ?>
                                                <div class="error"><?php echo form_error('Blogcategories[content_' . $language->code . ']'); ?></div>
                                                
                                                <br />
                                                <label class="control-label" for="Blogcategories[meta_keywords_<?php echo $language->code; ?>]"><?php echo $this->lang->line('Meta keywords'); ?></label>
                                                <input name="Blogcategories[meta_keywords_<?php echo $language->code; ?>]" value="<?php echo set_value('Blogcategories[meta_keywords_' . $language->code . ']', $blogcategories['meta_keywords_'.$language->code]); ?>" type="text" class="form-control" id="Blogcategories[meta_keywords_<?php echo $language->code; ?>]">
                                                <div class="error"><?php echo form_error('Blogcategories[meta_keywords_' . $language->code . ']'); ?></div>

                                                <br />
                                                <label class="control-label" for="Blogcategories[meta_description_<?php echo $language->code; ?>]"><?php echo $this->lang->line('Meta description'); ?></label>
                                                <input name="Blogcategories[meta_description_<?php echo $language->code; ?>]" value="<?php echo set_value('Blogcategories[meta_description_' . $language->code . ']', $blogcategories['meta_description_'.$language->code]); ?>" type="text" class="form-control" id="Blogcategories[meta_description_<?php echo $language->code; ?>]">
                                                <div class="error"><?php echo form_error('Blogcategories[meta_description_' . $language->code . ']'); ?></div>

                                            </div>
                                        <?php } ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    
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
        $('#current-image').click(function() {
//            $('#image').click();
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
    });
</script>