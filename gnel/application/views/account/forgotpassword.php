<?php //echo "<pre>"; print_r($category_product_counts); ?>
<div id="content">
    <div class="breadcrumb"> <a href="<?php echo site_url(); ?>"><?php echo $this->lang->line('Home'); ?></a> » <a href="<?php echo site_url('account'); ?>"><?php echo $this->lang->line('My Account'); ?></a> » <?php echo $this->lang->line('Forgot Password'); ?></div>
    <h1><span class="h1-top"><?php echo $this->lang->line('Forgot Password'); ?></span></h1>
    <div class="information_content">
	<?php if(!isset($email_sent)) { ?>
      <form action="" method="post">
        <h3><?php echo $this->lang->line('Insert email to get new password.'); ?></h3>
        <div class="content">
          <table class="form">
            <tbody>
           	  <tr>
                <td class="desc"><span class="required">*</span> <?php echo $this->lang->line('Email:'); ?></td>
              </tr>
              <tr>
                <td class="txtinput"><input type="email" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" required="required"></td>
              </tr>
			  
            </tbody>
          </table>
        </div>
		<?php if(isset($wrong_email)) {?>
			<div class="wrong-login"><?php echo $this->lang->line('Please insert right email'); ?></div>
		<?php } ?>
        <div class="buttons">
          <div class="right smaller">
            <input type="submit" name="get_password" value="<?php echo $this->lang->line('Get Password'); ?>" class="button">
          </div>
        </div>
      </form>
	  <?php } else if(isset($password_email_sent)){ ?>
		<?php echo $this->lang->line('New password has been sent to your Email.'); ?>
		<br/>
		<br/>
		<br/>
		<a href="<?php echo site_url('account'); ?>"><input type="submit" name="login" value="<?php echo $this->lang->line('Login'); ?>" class="button"></a>

	  <?php } else if(isset($activation_email_sent)) {?>
            Activation email send to your email, please activate your account.
      <?php } ?>
    </div>
  </div> 