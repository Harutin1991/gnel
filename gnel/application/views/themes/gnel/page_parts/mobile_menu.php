<div class="mobile_menu">
	<div class="left">
    	<a class="button open-left" rel=""><i class="fa fa-bars fa-fw"></i><span>&nbsp;<? echo $this->lang->line('Categories'); ?></span></a>
    </div>
    <div class="m-center menucaroussel">
    	<ul class="slides" data-snap-ignore="true">
        	<li><div class="search">
                    <div class="button-search"><a href="<?php echo site_url('product/search/'); ?>" class='search-link'><i class="fa fa-search fa-fw"></i></a></div>
        <input type="text" name="search" placeholder="Search" value="<?php echo isset($keyword)? $keyword : ''; ?>">
      </div></li>
      <li><a class="button" href="<?php echo site_url(''); ?>"><i class="fa fa-home fa-fw"></i>&nbsp;<?php echo $this->lang->line('Home'); ?></a>
          <a class="button" href="<?php echo site_url('shopping/cart'); ?>"><i class="fa fa-shopping-cart fa-fw"></i>&nbsp;<?php echo $this->lang->line('Cart'); ?></a></li>
        	<li><a class="button" href="<?php echo site_url('shopping/checkout'); ?>"><i class="fa fa-money fa-fw"></i>&nbsp;<?php echo $this->lang->line('Checkout'); ?></a>
                <a class="button account" href="<?php echo site_url('account/my'); ?>"><i class="fa fa-male fa-fw"></i>&nbsp;<?php echo $this->lang->line('Account'); ?></a></li>
        	<li><a class="button wishlist" href="<?php echo site_url('page/contact-us'); ?>"><i class="fa fa-envelope fa-fw"></i>&nbsp;<?php echo $this->lang->line('Contact us'); ?></a>
                <!--<a class="button wishlist" href="wishlist.html"><i class="fa fa-gift fa-fw"></i>&nbsp;Wishlist</a>-->
            </li>
        </ul>
    </div>
<!--    <div class="m-center-title">Welcome to Things for Cuties</div> -->
    <div class="right"><div class="floatright"><a class="button open-right" rel=""><span><? echo $this->lang->line('Menu'); ?>&nbsp;</span><i class="fa fa-bars fa-fw"></i></a></div></div>
</div>