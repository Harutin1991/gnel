<?php if ($this->session->flashdata('message') == 'add_success'): ?>
    <div style="display: none">
        <button  class="btn btn-primary noty" data-noty-options="{&quot;text&quot;:&quot;<?php echo $this->lang->line('Partner added successfully'); ?>&quot;,&quot;layout&quot;:&quot;topCenter&quot;,&quot;type&quot;:&quot;success&quot;}">
            <i class="glyphicon glyphicon-bell icon-white"></i> Top Center (fade)
        </button>
    </div>
<?php endif; ?>
<?php if ($this->session->flashdata('message') == 'edit_success'): ?>
    <div style="display: none">
        <button  class="btn btn-primary noty" data-noty-options="{&quot;text&quot;:&quot;<?php echo $this->lang->line('Partner has updated successfully'); ?>&quot;,&quot;layout&quot;:&quot;topCenter&quot;,&quot;type&quot;:&quot;success&quot;}">
            <i class="glyphicon glyphicon-bell icon-white"></i> Top Center (fade)
        </button>
    </div>
<?php endif; ?>


<?php // echo "<pre>"; var_dump($partner); echo "</pre>"; ?>
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
                                    <label class="control-label" for="link"><?php echo $this->lang->line('Link'); ?></label>
                                    <input name="Partner[link]" value="<?php echo set_value('Partner[link]', $partner['link']); ?>" type="text" class="form-control" id="link"/>
                                    <div class="error"><?php echo form_error('Partner[link]'); ?></div>
                                </td>
                            </tr>
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
                                                <label class="control-label <?php echo $is_default ? "required" : ""; ?>" for="Partner[name_<?php echo $language->code; ?>]"><?php echo $this->lang->line('Name'); ?></label>
                                                <input name="Partner[name_<?php echo $language->code; ?>]" value="<?php echo set_value('Partner[name_' . $language->code . ']', $partner['name_'.$language->code]); ?>" type="text" class="form-control" id="name" <?php echo $is_default ? "required='required'" : ""; ?>>
                                                <div class="error"><?php echo form_error('Partner[name_' . $language->code . ']'); ?></div>

                                                <br />
                                                <label class="control-label" for="Partner[meta_keywords_<?php echo $language->code; ?>]"><?php echo $this->lang->line('Meta keywords'); ?></label>
                                                <input name="Partner[meta_keywords_<?php echo $language->code; ?>]" value="<?php echo set_value('Partner[meta_keywords_' . $language->code . ']', $partner['meta_keywords_'.$language->code]); ?>" type="text" class="form-control" id="meta_keywords">
                                                <div class="error"><?php echo form_error('Partner[meta_keywords_' . $language->code . ']'); ?></div>

                                                <br />
                                                <label class="control-label" for="Partner[meta_description_<?php echo $language->code; ?>]"><?php echo $this->lang->line('Meta description'); ?></label>
                                                <input name="Partner[meta_description_<?php echo $language->code; ?>]" value="<?php echo set_value('Partner[meta_description_' . $language->code . ']', $partner['meta_description_'.$language->code]); ?>" type="text" class="form-control" id="meta_description">
                                                <div class="error"><?php echo form_error('Partner[meta_description_' . $language->code . ']'); ?></div>

                                                <br />
                                                <label class="control-label" for="Partner[description_<?php echo $language->code; ?>]"><?php echo $this->lang->line('Description'); ?></label>
                                                <?php editor("Partner[description_" . $language->code . "]", 'band_description_' . $language->code, set_value('Partner[description_' . $language->code . ']', $partner['description_'.$language->code])); ?>
                                                <div class="error"><?php echo form_error('Partner[description_' . $language->code . ']'); ?></div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="upload_image_wrapper">
                                    <?php $img_url = $partner['image'] != '' ? $this->config->item('frontend_url') . 'images/partner/' . $partner['image'] : base_url('img/upload-icon.png'); ?>
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