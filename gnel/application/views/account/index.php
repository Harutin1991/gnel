  <div id="content">
    <div class="breadcrumb"> <a href="<?php echo site_url(); ?>"><?php echo $this->lang->line('Home'); ?></a> » <a href="<?php echo site_url('account'); ?>"><?php echo $this->lang->line('My Account'); ?></a> </div>
    <h1><span class="h1-top"><?php echo $this->lang->line('Account'); ?></span></h1>
    <div class="information_content">
      <h2><?php echo $this->lang->line('My Account'); ?></h2>
      <div class="content">
        <ul class="greenrect">
          <li><a href="<?php echo site_url('account/my'); ?>"><?php echo $this->lang->line('Edit your account information'); ?></a></li>
          <li><a href="<?php echo site_url('account/password'); ?>"><?php echo $this->lang->line('Change your password'); ?></a></li>
          <li><a href="<?php echo site_url('account/address'); ?>"><?php echo $this->lang->line('Modify your address book entries'); ?></a></li>
        </ul>
      </div>
      <h2><?php echo $this->lang->line('My Orders'); ?></h2>
      <div class="content">
        <ul class="greenrect">
          <li><a href="<?php echo site_url('account/points'); ?>"><?php echo $this->lang->line('View your points history'); ?></a></li>
          <li><a href="<?php echo site_url('account/orderhistory'); ?>"><?php echo $this->lang->line('View your order history'); ?></a></li>

        </ul>
      </div>
      <h2><?php echo $this->lang->line('My Comments'); ?></h2>
      <div class="content">
        <ul class="greenrect">
          <li><a href="<?php echo site_url('account/comments/products'); ?>"><?php echo $this->lang->line('View your products comments'); ?></a></li>
          <li><a href="<?php echo site_url('account/comments/blognews'); ?>"><?php echo $this->lang->line('View your blognews comments'); ?></a></li>

        </ul>
      </div>
    </div>
  </div>