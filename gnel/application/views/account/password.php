<div id="content">
    <div class="breadcrumb"> <a href="<?php echo site_url(); ?>"><?php echo $this->lang->line('Home'); ?></a> » <a href="<?php echo site_url('account'); ?>"><?php echo $this->lang->line('My Account'); ?></a> » <a href="<?php echo site_url('account/register'); ?>"><?php echo $this->lang->line('Register'); ?></a> </div>
    <h1><span class="h1-top"><?php echo $this->lang->line('Register'); ?></span></h1>
    <div class="information_content">
      <form action="" method="post" enctype="multipart/form-data">
      
        <div class="content">
          <table class="form">
            <tbody>
              <tr>
                <td class="desc"><span class="required">*</span><?php echo $this->lang->line('Current Password'); ?></td>
              </tr>
              <tr>
                <td class="txtinput"><input type="password" name="current_password" value="" required="required"></td>
              </tr>
			  <?php if(isset($wrong_password)) { ?>
				<tr><td class="notification"><?php echo $this->lang->line('Wrong Password'); ?></td></tr>
			  <?php } ?>
			  <tr>
                <td class="desc"><span class="required">*</span> <?php echo $this->lang->line('New Password').$this->lang->line(':'); ?></td>
              </tr>
              <tr>
                <td class="txtinput"><input type="password" name="password" value="" required="required"></td>
              </tr> 
			  <tr>
                <td class="desc"><span class="required">*</span><?php echo $this->lang->line('Repeat password').$this->lang->line(':'); ?></td>
              </tr>
              <tr>
                <td class="txtinput"><input type="password" name="repeat_password" value="" required="required"></td>
              </tr>
				<tr>
					<td class="notification pass_note">
						<?php if(isset($password_match) && !$password_match) { ?>
							<?php echo $this->lang->line('Password are not match'); ?>
						<?php } ?>
						<?php if(isset($update_error)) { ?>
							<?php echo $this->lang->line('Please try again'); ?>
						<?php } ?>
						<?php if(isset($short_password)) { ?>
							<?php echo $this->lang->line("Password must contain at least 6 symbhols"); ?>
						<?php } ?>
						<?php if(isset($update_success)) { ?>
							<p class='success'><?php echo $this->lang->line("Password updated successfully"); ?></p>
						<?php } ?>
					</td>
				</tr>
            </tbody>
          </table>
        </div>
		<?php if(isset($insertion_error)) { ?>
			<div class="notification"><?php echo $this->lang->line('Please try again'); ?></div>
		<?php } ?>
        <div class="buttons">
          <div class="right smaller">
            <input type="submit" value="<?php echo $this->lang->line('Update Password'); ?>" name="update_password" class="button" >
          </div>
        </div>
      </form>
    </div>
  </div> 
  
  <script>
  jQuery(document).ready(function($){
	//$('input[name="repeat_password"').keyup(function(){
	$('input[type="submit"').click(function(){
		var pass = $('input[name="password"').val();
		var rep_pass = $('input[name="repeat_password"').val();
		if( pass != '') {
			if(pass.length > 5 ) {
				if(pass == rep_pass) {
					//$('input[type="submit"').removeAttr('disabled');
					$('.pass_note').text('');
				} else {
					//$('input[type="submit"').attr('disabled','disabled');
					$('.pass_note').text('<?php echo $this->lang->line("Passwords are not match"); ?>');
					return false;
				}
			} else {
				$('.pass_note').text('<?php echo $this->lang->line("Password must contain at least 6 characters"); ?>');
				return false;
			}
		}
	});
  });
  </script>