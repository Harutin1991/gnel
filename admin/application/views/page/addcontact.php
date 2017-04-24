<?php if ($this->session->flashdata('message') == 'add_success'): ?>
    <div style="display: none">
        <button  class="btn btn-primary noty" data-noty-options="{&quot;text&quot;:&quot;<?php echo $this->lang->line('Contact_topic added successfully'); ?>&quot;,&quot;layout&quot;:&quot;topCenter&quot;,&quot;type&quot;:&quot;success&quot;}">
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
                    <?php echo $this->lang->line('contact'); ?>
                </h2>
                <div class="box-icon">
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
                </div>
            </div>
            <div class="box-content">
                <h3 style="margin: 20px"><?php  echo $this->lang->line('add_topic'); ?></h3>
                <hr>
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
                                            <label class="control-label <?php echo $is_default ? 'required' : ''; ?>" for="Contact_topic[title_<?php echo $language->code; ?>]"><?php echo $this->lang->line('Title'); ?></label>
                                            <input name="Contact_topic[title_<?php echo $language->code; ?>]" value="<?php echo set_value('Contact_topic[title_' . $language->code . ']'); ?>" type="text" class="form-control" id="title" <?php echo $is_default ? 'required="required"' : ''; ?>>
                                            <div class="error"><?php echo form_error('Contact_topic[title_' . $language->code . ']'); ?></div>

                                            <br />
                                            <label class="control-label" for="Contact_topic[short_content_<?php echo $language->code; ?>]"><?php echo $this->lang->line('Short Content'); ?></label>
                                            <input name="Contact_topic[short_content_<?php echo $language->code; ?>]" value="<?php echo set_value('Contact_topic[short_content_' . $language->code . ']'); ?>" type="text" class="form-control" id="title">
                                            <div class="error"><?php echo form_error('Contact_topic[short_content_' . $language->code . ']'); ?></div>

                                            <br />
                                            <label class="control-label" for="Contact_topic[content_<?php echo $language->code; ?>]"><?php echo $this->lang->line('Content'); ?></label>
                                            <?php editor("Contact_topic[content_" . $language->code . "]", 'Contact_topic[content_' . $language->code, set_value('Contact_topic[content_' . $language->code . ']')); ?>
                                            <div class="error"><?php echo form_error('Contact_topic[content_' . $language->code . ']'); ?></div>

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

        $('#myTab a:first').tab('show');

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


    });




</script>