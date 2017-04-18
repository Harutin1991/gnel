<div id="content">
    <div class="breadcrumb"> <a href="<?php echo site_url(); ?>"><?php echo $this->lang->line('Home'); ?></a> » <a href="<?php echo site_url('account'); ?>"><?php echo $this->lang->line('My Account'); ?></a> » <a href="<?php echo site_url('account/register'); ?>"><?php echo $this->lang->line('Register'); ?></a> </div>
    <h1><span class="h1-top"><?php echo $this->lang->line('Register'); ?></span></h1>
    <div class="information_content">
		<form action="" method="post" enctype="multipart/form-data">
	
			<div class="content">
				<table class="form">
					<tbody>
						<tr>
							<td class="desc"> <?php echo $this->lang->line('First Name:'); ?></td>
						</tr>
						<tr>
							<td class="txtinput"><input type="text" name="first_name" value="<?php echo isset($_POST['first_name']) ? $_POST['first_name'] : ''; ?>"></td>
						</tr>
						<tr>
							<td class="desc"> <?php echo $this->lang->line('Last Name:'); ?></td>
						</tr>
						<tr>
							<td class="txtinput"><input type="text" name="last_name" value="<?php echo isset($_POST['last_name']) ? $_POST['last_name'] : ''; ?>"></td>
						</tr>
						<tr>
							<td class="desc"><span class="required">*</span><?php echo $this->lang->line('Email:'); ?></td>
						</tr>
						<tr>
							<td class="txtinput"><input type="email" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" required="required"></td>
						</tr>
						<?php if (isset($email_exists) ) { ?>
							<tr><td class="notification"><?php echo $this->lang->line('Email already exists'); ?></td></tr>
						<?php } ?>
						<?php if (isset($wrong_email)) { ?>
							<tr><td class="notification"><?php echo $this->lang->line('Wrong Email'); ?></td></tr>
						<?php } ?>
						<tr>
							<td class="desc"><span class="required">*</span> <?php echo $this->lang->line('Password') . $this->lang->line(':'); ?></td>
						</tr>
						<tr>
							<td class="txtinput"><input type="password" name="password" value="" required="required"></td>
						</tr> 
						<tr>
							<td class="desc"><span class="required">*</span><?php echo $this->lang->line('Repeat password') . $this->lang->line(':'); ?></td>
						</tr>
						<tr>
							<td class="txtinput"><input type="password" name="repeat_password" value="" required="required"></td>
						</tr>
						<tr>
							<td class="notification pass_note">
								<?php if (isset($password_match) && !$password_match) { ?>
									<?php echo $this->lang->line('Passwords are not match'); ?>
								<?php } ?>
								<?php if (isset($short_password)) { ?>
									<?php echo $this->lang->line("Password must contain at least 6 characters"); ?>
								<?php } ?>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<?php if (isset($insertion_error)) { ?>
				<div class="notification">Please try again</div>
			<?php } ?>
			<div class="buttons">
				<div class="right smaller">
					<input type="submit" value="<?php echo $this->lang->line('Register'); ?>" name="register" class="button" >
				</div>
			</div>
		</form>
    </div>
</div> 

<script>
	jQuery(document).ready(function($) {
		//$('input[name="repeat_password"').keyup(function(){
		$('input[type=submit]').click(function() {
			var pass = $('input[name=password]').val();
			var rep_pass = $('input[name=repeat_password]').val();
			console.log(pass);
			console.log(rep_pass);
			if (pass != '') {
				if ( pass.length > 5) {
					if (pass == rep_pass) {
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