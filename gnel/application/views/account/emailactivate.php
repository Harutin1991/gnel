<?php //echo "<pre>"; print_r($category_product_counts); ?>
<div id="content">
        <div class="breadcrumb"> <a href="<?php echo site_url(); ?>"><?php echo $this->lang->line('Home'); ?></a>
    <?php if(isset($logged) && $logged) { ?>
            » <a href="<?php echo site_url('account'); ?>"><?php echo $this->lang->line('My Account'); ?></a> » <?php echo $this->lang->line('Activate Account'); ?></div>
    <?php } ?>
    <h1><span class="h1-top"><?php echo $this->lang->line('Activate Account'); ?></span></h1>
    <div class="information_content">
        
        <div class="content">
            <?php if(isset($logged) && $logged) { ?>
                 <?php echo $this->lang->line('Congratulations.'); ?>
                <?php echo $this->lang->line('Dear'); ?> <?php echo $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name'); ?>, <?php echo $this->lang->line('your account has been activated.'); ?>
            <?php } else { ?>
            <h3><?php echo $this->lang->line('Please go to your email and activate your account.'); ?></h3>
            <?php } ?>
        </div>

		<br/>
		<br/>
		<br/>


    </div>
  </div> 
