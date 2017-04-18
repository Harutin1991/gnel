 <?php if ($this->session->flashdata('message') == 'edit_success'): ?>
    <div style="display: none">
        <button  class="btn btn-primary noty" data-noty-options="{&quot;text&quot;:&quot;<?php echo $this->lang->line('Language has edited successfully'); ?>&quot;,&quot;layout&quot;:&quot;topCenter&quot;,&quot;type&quot;:&quot;success&quot;}">
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
                <table class="span5">
                    <form method="POST" >
                        <tbody>
                            <tr>
                                <td>
                                    <label class="control-label required" for="inputSuccess1"><?php echo $this->lang->line('Code'); ?></label>
                                    <input name="Languages[code]" value="<?php echo set_value('Languages[code]', $lang['code']); ?>" type="text" class="form-control" id="name">
                                    <div class="error"><?php echo form_error('Languages[code]'); ?></div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <ul class="nav nav-tabs" id="myTab">
                                        <?php foreach ($languages as $language): ?>
                                            <?php if ($language->code == $default_language): ?>
                                                <li class="active">
                                                    <a href="#<?php echo $language->code; ?>"><?php echo $language->name; ?></a>
                                                </li>
                                            <?php else: ?>
                                                <li>
                                                    <a href="#<?php echo $language->code; ?>"><?php echo $language->name; ?></a>
                                                </li>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </ul>
                                    <div class="tab-content">
                                        <?php foreach ($languages as $language): ?>
                                            <?php if ($language->code == $default_language): ?>
                                                <div class="tab-pane active" id="<?php echo $language->code; ?>">
                                                    <br />
                                                    <label class="control-label required" for="Languages[name_<?php echo $language->code; ?>]"><?php echo $this->lang->line('Name'); ?></label>
                                                    <input name="Languages[name_<?php echo $default_language; ?>]" value="<?php echo set_value('Languages[name_'.$language->code.']', $lang['name_'.$language->code]); ?>" type="text" class="form-control" id="name">
                                                    <div class="error"><?php echo form_error('Languages[name_'.$language->code.']'); ?></div>
                                                </div>
                                            <?php else: ?>
                                                <div class="tab-pane" id="<?php echo $language->code; ?>">
                                                    <br />
                                                    <label class="control-label" for="Languages[name_<?php echo $language->code; ?>]"><?php echo $this->lang->line('Name'); ?></label>
                                                    <input name="Languages[name_<?php echo $language->code; ?>]" value="<?php echo set_value('Languages[name_'.$language->code.']', $lang['name_'.$language->code]); ?>" type="text" class="form-control" id="name">
                                                    <div class="error"><?php echo form_error('Languages[name_'.$language->code.']'); ?></div>
                                                </div>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </div>
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
/*
$(document).ready(function () {
    setTimeout(function () {
        $('.noty').trigger('click');
    }, 1000);
});
*/
</script>