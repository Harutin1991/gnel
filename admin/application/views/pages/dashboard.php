
<br/><br/>
<div class="sortable row-fluid ui-sortable"> 
    <a data-rel="tooltip" class="well span3 top-block" href="<?php echo site_url('product'); ?>" data-original-title="All pages">
        <span class="icon32 icon-orange icon-script"></span>
        <div>Ապրանքներ</div>
        <div>&nbsp;</div>
        <span class="notification yellow"><?php echo $product_count; ?></span>  </a> 
    <a data-rel="tooltip" class="well span3 top-block" href="<?php echo site_url('brand'); ?>" data-original-title="">
        <span class="icon32 icon-red icon-page"></span>
        <div>Ապրանքանիշեր</div>
        <div>&nbsp;</div>
        <span class="notification yellow"><?php echo $brand_count; ?></span>  </a>

	<a data-rel="tooltip" class="well span3 top-block" href="<?php echo site_url('product_comments'); ?>" data-original-title="">
		<i class="glyphicon glyphicon-envelope red"></i>
		<div><?php echo $this->lang->line('Product_comments'); ?> </div>
		<span class="notification"><?php echo $product_comments; ?></span>  </a>
</div>
<br/><br/>
<div class="sortable row-fluid ui-sortable"> 
<?php if($this->admin_id == $this->config->item('super_global_admin_id')) { ?>
	<a data-toggle="tooltip" title="" class="well span3 top-block" href="#" data-original-title="">
		<i class="glyphicon glyphicon-user blue"></i>

		<div>Օգտատերեր </div>
		
		<span class="notification"><?php echo $users ?></span>
	</a>
	<?php } ?>
	<?php if($this->admin_id == $this->config->item('super_global_admin_id')) { ?>
		<a data-toggle="tooltip" title="" class="well span3 top-block" href="<?php echo site_url('order'); ?>" data-original-title="">
			<i class="glyphicon glyphicon-shopping-cart blue"></i>

			<div>Պատվերներ </div>
			
			<span class="notification"><?php echo $orders ?></span>
		</a>
	<?php } ?>
	<a data-rel="tooltip" class="well span3 top-block" href="<?php echo site_url('blognews_comments'); ?>" data-original-title="">
		<i class="glyphicon glyphicon-envelope red"></i>
		<div><?php echo $this->lang->line('Blognews_comments'); ?> </div>
		<span class="notification"><?php echo $blognews_comments; ?></span>  </a>
</div>