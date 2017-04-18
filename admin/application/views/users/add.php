<div class="row-fluid sortable"> 
    <div class="box span10">
        <div class="box-header well" data-original-title>
            <h2><?php echo $this->lang->line('Add'); ?></h2>
        </div>
        <div class="box-content">
            <table class="span5">
                <form method="POST" action="" >
                    <tbody>
                        <tr>
                            <td>
                                <label class="control-label required" for="login"><?php echo $this->lang->line('Login'); ?></label>
                                <input name="login" value="" class="form-control" id="login" type="text">
                                <label class="control-label" for="email"><?php echo $this->lang->line('Email'); ?></label>
                                <input name="email" value="" class="form-control" id="email" type="text">
                                <div class="error"><?php echo form_error('login');?></div>
                                <label class="control-label required" for="password"><?php echo $this->lang->line('Password'); ?></label>
                                <input name="password" value="" class="form-control" id="password" type="password">
                                <div class="error"><?php echo form_error('password');?></div>
                                <label class="control-label required" for="repeat_password"><?php echo $this->lang->line('Repeat password'); ?></label>
                                <input name="repeat_password" value="" class="form-control" id="repeat_password" type="password">
                                <div class="error"><?php echo form_error('repeat_password');?></div>
                            </td>
                            <td>
                                <fieldset>
                                    <legend class="required"><?php echo $this->lang->line('Roles'); ?></legend>
                                    <div class="error"><?php echo form_error('roles');?></div>
                                    <?php foreach ($roles as $index => $element) { ?>                                           
                                        <nobr><input name="roles" value="<?php echo $element['rol_id']; ?>" id="roles[<?php echo $index; ?>]" type="radio">
                                            <label  for="roles[<?php echo $index; ?>]"><?php echo $element['rol_name']; ?></label></nobr> </br>
                                    <?php } ?>
                                </fieldset>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input class="btn btn-primary" value="<?php echo $this->lang->line('Add'); ?>" type="submit" name="submit">
                            </td>
                        </tr>
                    </tbody>
                </form>
            </table>

        </div>
    </div>
</div>