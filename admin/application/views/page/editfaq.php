<?php if ($this->session->flashdata('message') == 'add_success'): ?>
    <div style="display: none">
        <button  class="btn btn-primary noty" data-noty-options="{&quot;text&quot;:&quot;<?php echo $this->lang->line('Faq added successfully'); ?>&quot;,&quot;layout&quot;:&quot;topCenter&quot;,&quot;type&quot;:&quot;success&quot;}">
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
                <h3 style="margin: 20px"><?php  echo $this->lang->line('Add'); ?></h3>
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
                                            <label class="control-label <?php echo $is_default ? 'required' : ''; ?>" for="Faq[question_<?php echo $language->code; ?>]"><?php echo $this->lang->line('question'); ?></label>
                                            <input name="Faq[question_<?php echo $language->code; ?>]" value="<?php echo set_value('Faq[question_' . $language->code . ']', $faq['question_' . $language->code]); ?>" type="text" class="form-control" id="question" <?php echo $is_default ? 'required="required"' : ''; ?>>
                                            <div class="error"><?php echo form_error('Faq[question_' . $language->code . ']'); ?></div>

                                            <br />
                                            <label class="control-label" for="Faq[answer_<?php echo $language->code; ?>]"><?php echo $this->lang->line('answer'); ?></label>
                                            <?php editor("Faq[answer_" . $language->code . "]", 'Faq[answer_' . $language->code, set_value('Faq[answer_' . $language->code . ']', $faq['answer_' . $language->code])); ?>
                                            <div class="error"><?php echo form_error('Faq[answer_' . $language->code . ']'); ?></div>

                                        </div>
                                    <?php } ?>
                                </div>
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


</script>