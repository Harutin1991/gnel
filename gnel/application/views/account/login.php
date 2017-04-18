<?php //echo "<pre>"; print_r($category_product_counts); ?>
<div id="content">
    <div class="breadcrumb"> <a href="<?php echo site_url(); ?>"><?php echo $this->lang->line('Home'); ?></a> » <a href="<?php echo site_url('account'); ?>"><?php echo $this->lang->line('My Account'); ?></a> » <?php echo $this->lang->line('Login'); ?></div>
    <h1><span class="h1-top"><?php echo $this->lang->line('Login'); ?></span></h1>
    <div class="information_content">
      <form action="" method="post" enctype="multipart/form-data">
        <div class="content">
          <table class="form">
            <tbody>
           	  <tr>
                <td class="desc"><span class="required">*</span> <?php echo $this->lang->line('Email:'); ?></td>
              </tr>
              <tr>
                <td class="txtinput"><input type="email" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>"></td>
              </tr>
              <tr>
                <td class="desc"><span class="required">*</span> <?php echo $this->lang->line('Password') . $this->lang->line(':'); ?></td>
              </tr>
			  <tr>
                <td class="txtinput"><input type="password" name="password" value=""></td>
              </tr>
			  <tr>
                <td class="forg_pass"><a href="<?php echo site_url('account/forgotpassword'); ?>"><?php echo $this->lang->line('Forgotten Password ?'); ?></a> / <a href="<?php echo site_url('account/register'); ?>"><?php echo $this->lang->line('Register'); ?></a> </td>
              </tr>
			  
            </tbody>
          </table>
        </div>
		<?php if(isset($wrong_login)) {?>
			<div class="wrong-login"><?php echo $this->lang->line('Please insert right data'); ?> </div>
		<?php } ?>
        <div class="buttons">
          <div class="right smaller">
            <input type="submit" name="login" value="<?php echo $this->lang->line('Login'); ?>" class="button">
          </div>
        </div>
      </form>
    </div>
  </div>