<?php if ($this->session->flashdata('message') == 'edit_success'): ?>
    <div style="display: none">
        <button  class="btn btn-primary noty" data-noty-options="{&quot;text&quot;:&quot;<?php echo $this->lang->line('Blog has updated successfully'); ?>&quot;,&quot;layout&quot;:&quot;topCenter&quot;,&quot;type&quot;:&quot;success&quot;}">
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
                                                <label class="control-label <?php echo $is_default ? "required" : ""; ?>" for="Blognews[title_<?php echo $language->code; ?>]"><?php echo $this->lang->line('Title'); ?></label>
                                                <input name="Blognews[title_<?php echo $language->code; ?>]" value="<?php echo set_value('Blognews[title_' . $language->code . ']', $blognews['title_'.$language->code]); ?>" type="text" class="form-control" id="name" <?php echo $is_default ? "required='required'" : ""; ?>>
                                                <div class="error"><?php echo form_error('Blognews[title_' . $language->code . ']'); ?></div>

                                                <br />
                                                <label class="control-label" for="Blognews[short_content_<?php echo $language->code; ?>]"><?php echo $this->lang->line('Short Content'); ?></label><br/>
                                                <textarea name="Blognews[short_content_<?php echo $language->code; ?>]" class="form-control" id="short_content"><?php echo set_value('Blognews[short_content_' . $language->code . ']', $blognews['short_content_'.$language->code]); ?></textarea>
                                                <div class="error"><?php echo form_error('Blognews[meta_keywords_' . $language->code . ']'); ?></div>
                                                
                                                <br />
                                                <label class="control-label" for="Blognews[content_<?php echo $language->code; ?>]"><?php echo $this->lang->line('Content'); ?></label>
                                                <?php editor("Blognews[content_" . $language->code . "]", 'band_content_' . $language->code, set_value('Blognews[content_' . $language->code . ']', $blognews['content_'.$language->code])); ?>
                                                <div class="error"><?php echo form_error('Blognews[content_' . $language->code . ']'); ?></div>

                                                <br />
                                                <label class="control-label" for="Blognews[meta_description_<?php echo $language->code; ?>]"><?php echo $this->lang->line('Meta description'); ?></label>
                                                <input name="Blognews[meta_description_<?php echo $language->code; ?>]" value="<?php echo set_value('Blognews[meta_description_' . $language->code . ']', $blognews['meta_description_'.$language->code]); ?>" type="text" class="form-control" id="meta_description">
                                                <div class="error"><?php echo form_error('Blognews[meta_description_' . $language->code . ']'); ?></div>

                                                <br />
                                                <label class="control-label" for="Blognews[audio_link]"><?php echo $this->lang->line('Audio Link'); ?></label>
                                                <input name="Blognews[audio_link]" value="<?php echo set_value('Blognews[audio_link]', $blognews['audio_link']); ?>" type="text" class="form-control" id="audio_link">
                                                <div class="error"><?php echo form_error('Blognews[audio_link]'); ?></div>

                                                <br />
                                                <label class="control-label" for="Blognews[video_link]"><?php echo $this->lang->line('Video Link'); ?></label>
                                                <input name="Blognews[video_link]" value="<?php echo set_value('Blognews[video_link]', $blognews['video_link']); ?>" type="text" class="form-control" id="video_link">
                                                <div class="error"><?php echo form_error('Blognews[video_link]'); ?></div>

                                            </div>
                                        <?php } ?>
                                    </div>
                                </td>
                            </tr>
<!--                            <tr>-->
<!--                                <td>-->
<!--                                    <label class="control-label" >--><?php //echo $this->lang->line('Edit images'); ?><!-- <a href="--><?php //echo base_url('blognews/addImages/' . $blognews['id']); ?><!--">--><?php //echo $this->lang->line('here'); ?><!--</a></label>-->
<!--                                    <div class="image-box">-->
<!--                                        <div>-->
<!--                                            --><?php ////echo "<pre>";print_r($product); echo "</pre>"; ?>
<!--                                            --><?php //$img_url = isset($blognews['image']) && $blognews['image'] != '' ? $this->config->item('frontend_url') . 'images/blognews/' . $blognews['image'] : base_url('img/upload-icon.png'); ?>
<!--                                            <a href="--><?php //echo base_url('blognews/addImages/' . $blognews['id']); ?><!--"><img id="current-image" src="--><?php //echo $img_url; ?><!--" width="100" title="--><?php //echo $this->lang->line('Change image'); ?><!--" />-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </td>-->
<!--                            </tr>-->
                            <tr>
                                <td class="upload_image_wrapper">
                                    <?php $img_url = $blognews['image'] != '' ? $this->config->item('frontend_url') . 'images/blognews/' . $blognews['image'] : base_url('img/upload-icon.png'); ?>
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