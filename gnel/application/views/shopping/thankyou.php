<div id="content">
    <div class="breadcrumb"> <a href="<?php echo site_url(); ?>"><?php echo $this->lang->line('Home'); ?></a> » <?php echo $this->lang->line('Shopping Cart'); ?> </div>
    <h1><span class="h1-top"><?php echo $this->lang->line('Shopping Cart'); ?> </span></h1>
    <!--<form action="shoppingcart.html" method="post" enctype="multipart/form-data">-->
    <!--</form>-->
    <div class="information_content">
		<?php echo $this->lang->line('Thank you, your order created successfully, our operator will connect with you'); ?>
		

        <br/>
        <br/>
        <br/>
        <?php if(!isset($logged) || !$logged) {?>
            <a href="<?php echo site_url('account'); ?>"><input type="submit" name="login" value="<?php echo $this->lang->line('Login'); ?>" class="button"></a>
        <?php } ?>
    </div>
</div>
