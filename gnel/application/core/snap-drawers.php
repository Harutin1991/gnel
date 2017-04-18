<div class="snap-drawers">
    <div class="snap-drawer snap-drawer-left">
        <div id="column-left">
            <div class="box">
                <div class="box-heading"><? echo $this->lang->line('Categories'); ?></div>
                <div class="box-content">
                    <?php echo drawLeftMenu($categories, $parent_categories_array, true); ?>
                </div>
            </div>
            <div class="clear"></div>
            <div class="box">
                <div>
                    <h1 class="title_module"><span><?php echo $this->lang->line('Latest'); ?></span></h1>
                    <div class="box-content">
                        <?php $c_prod = count($last_products); $i = 1; ?>
                        <?php if ($c_prod > 0) { ?>
                            <?php foreach ($last_products AS $product) { ?>
                                <?php $img_url = base_url('images/product/' . $product->prod_id . '/' . $product->image); ?>
                                <div class="box-product <?php echo $c_prod == $i++ ? 'last-item' : ''; ?>"> <a class="image" href="<?php echo product_url($product->prod_id, $product->name); ?>" title="<?php echo $this->lang->line('View more'); ?>"> <img src="<?php echo thumbImg($img_url); ?>" alt="<?php echo $product->name; ?>"> </a>
                                    <h3 class="name"><a href="<?php echo product_url($product->prod_id, $product->name); ?>" title="<?php echo $product->name; ?>"><?php echo $product->name; ?></a></h3>
                                    <p class="wrap_price"> <span class="price"><?php echo $product->price; ?> <?php echo $this->lang->line('AMD'); ?>  </p>
                                    <p class="submit">
                                        <input type="button" value="<?php echo $this->lang->line('Add to Cart'); ?>" class="button">
                                    </p>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>

    <div class="snap-drawer snap-drawer-right">
        <div id="column-left">

            <div class="box">
                <div class="box-heading">Information</div>
                <div class="box-content">
                    <ul class="box-category">
                        <li> <a href="about.html" class="active">About Us</a></li>
                        <li> <a href="blog.html">Blog</a> </li>
                        <li> <a href="comparison.html">Compare List</a></li>
                        <li> <a href="#">Terms & Conditions</a></li>
                    </ul>
                </div>
            </div>
            <div class="box">
                <div class="box-heading">Customer Service</div>
                <div class="box-content">
                    <ul class="box-category">
                        <li> <a href="contact.html" class="active">Contact Us</a></li>
                        <li> <a href="#">Returns</a> </li>
                        <li> <a href="#">Sitemap</a></li>
                    </ul>
                </div>
            </div>
            <div class="box">
                <div class="box-heading">Extras</div>
                <div class="box-content">
                    <ul class="box-category">
                        <li> <a href="brands.html" class="active">Brands</a></li>
                        <li> <a href="gifts.html">Gift Vouchers</a> </li>
                        <li> <a href="#">Affiliates</a></li>
                        <li> <a href="specials.html">Specials</a></li>
                    </ul>
                </div>
            </div>
            <div class="box">
                <div class="box-heading">My Account</div>
                <div class="box-content">
                    <ul>
                        <li><a href="myaccount.html">My Account</a></li>
                        <li><a href="#">Edit Account</a></li>
                        <li><a href="#">Password</a></li>
                        <li><a href="addressbook.html">Address Books</a></li>
                        <li><a href="wishlist.html">Wish List</a></li>
                        <li><a href="orderhistory.html">Order History</a></li>
                        <li><a href="#">Downloads</a></li>
                        <li><a href="#">Returns</a></li>
                        <li><a href="#">Transactions</a></li>
                        <li><a href="#">Newsletter</a></li>
                        <li class="last-item"><a href="#">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>