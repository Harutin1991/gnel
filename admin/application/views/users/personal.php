<div class="row-fluid sortable"> 
    <div class="box span10">
        <div class="box-header well" data-original-title>
            <h2><?php echo $this->lang->line('Edit'); ?></h2>
        </div>
        <div class="box-content">
            <table class="span5">
                <form method="POST" action="" >
                    <tbody>
                        <tr>
                            <td>
                                <label class="control-label" for="email"><?php echo $this->lang->line('Email'); ?></label>
                                <input name="email" value="<?php echo $edit_user['email']; ?>" class="form-control" id="email" type="text">
                                <div class="error"><?php echo form_error('login'); ?></div></br>
                                <input class="hidden_change_password" value="" type="hidden" name="hidden_change_password" />
                                <input class="btn btn-primary btn_change_password" value="<?php echo $this->lang->line('Change password');  ?>" type="button" name="change_password" />
                                <div class="change_password">
                                    <label class="control-label required" for="password"><?php echo $this->lang->line('Password'); ?></label>
                                    <input name="password" value="" class="form-control" id="password" type="password">
                                    <div class="error"><?php echo form_error('password'); ?></div>
                                    <label class="control-label required" for="repeat_password"><?php echo $this->lang->line('Repeat password'); ?></label>
                                    <input name="repeat_password" value="" class="form-control" id="repeat_password" type="password">
                                    <div class="error error2"><?php echo form_error('repeat_password'); ?></div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input class="btn btn-primary" value="<?php echo $this->lang->line('Edit'); ?>" type="submit" name="submit">
                            </td>
                        </tr>
                    </tbody>
                </form>
            </table>

        </div>
    </div>
</div>