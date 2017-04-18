
<div id="content">
    <div class="flex-container" data-snap-ignore="true">
        <?php $this->load->view('themes/babybuy/page_parts/flexslider.php'); ?>
    </div>

    <div class="banner-holder">
        <div class="banner banner1">
            <div class="login_block_img">
                <img src="<?php echo base_url(); ?>themes/babybuy/image/example-banner/banner2.png" alt="" title="">
            </div>
            <div class="login_block">
                <div class="for-wrong-login">
                    <?php if (isset($logged) && $logged) { ?>
                        <div class="loged_in_block">
                            <?php // echo "<pre>"; var_dump($user); ?>

                            <?php $img_url = $user['image'] != '' ? base_url('images/users/' . $user['id'] . '/' . $user['image']) : base_url('images/icons/user-icon.png'); ?>

                            <a href="<?php echo site_url('account'); ?>"><img src="<?php echo $img_url; ?>" alt="User image" id="user_image" alt="" title=""/></a>
                            <span>
                                <p class="login_name"><?php echo $user['first_name'] . ' ' . $user['last_name']; ?></p>
                                <p class="login_mail"><?php echo $user['email']; ?></p>
                                <p class="login_points"><?php echo  !$this->session->userdata('total_points') ? ' 0' : $this->session->userdata('total_points'); echo '  '.$this->lang->line('Points'); ?></p>
                            </span>
                        </div>
                    <?php } else { ?>
                        <form action="" method="post">
                            <table class="form">
                                <tbody>
                                    <tr>
                                        <td class="desc"> <?php echo $this->lang->line('Email:'); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="txtinput"><span><input type="email" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>"/></span></td>
                                    </tr>
                                    <tr>
                                        <td class="desc"> <?php echo $this->lang->line('Password') . $this->lang->line(':'); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="txtinput"><input type="password" name="password" value=""></td>
                                    </tr>
                                    <tr>
                                        <td class="forg_pass"><a href="<?php echo site_url('account/forgotpassword'); ?>"><?php echo $this->lang->line('Forgotten Password ?'); ?></a> / <a href="<?php echo site_url('account/register'); ?>"><?php echo $this->lang->line('Register'); ?></a> </td>
                                    </tr>

                                </tbody>
                            </table>
                            <div class="right smaller">
                                <input type="submit" name="login" value="<?php echo $this->lang->line('Login'); ?>" class="button">


                            </div>
                        </form>
                    <?php } ?>
                </div>
                <?php if (isset($wrong_login)) { ?>
                    <div class="wrong-login"><?php echo $this->lang->line('Please insert right data'); ?> </div>
                <? } ?>
            </div>


        </div>
        <div class="banner banner2">
            <div><img src="<?php echo base_url(); ?>themes/babybuy/image/example-banner/banner1.png" alt="" title=""> </div>
<!--            <div class="login_block">-->
<!---->
<!--                <p class="del_with_love">-->
<!--                    <a href="--><?php //echo site_url('delivery/'); ?><!--">--><?php //echo $this->lang->line('We delivery with love'); ?><!--</a>-->
<!--                </p>-->
<!--            </div>-->
            <div class="login_block home_blog_block">
                <a href="<?php echo site_url('blog'); ?>"> <img src="<?php echo base_url(); ?>themes/babybuy/image/blog_block.png" alt="blog" title="blog" /></a>
                <p class="del_with_love">
                    <a href="<?php echo site_url('blog'); ?>"><?php echo $this->lang->line('New page in Our website'); ?></a>
                </p>
            </div>
        </div>
    </div>
    <div class="box">
        <div>
            <h2 class="title_module h1_sim"><span><?php echo $this->lang->line('Special Products'); ?></span></h2>
            <div class="box-content">
                <?php foreach ($special_products AS $product) { ?>
                    <div class="box-product box-product_special image-product-<?php echo $product->prod_id; ?>">
                        <a class="image" href="<?php echo product_url($product->prod_id, $product->name); ?>" title="<?php echo $this->lang->line('View more'); ?>">
                            <img src="<?php echo thumbImg('images/product/' . $product->prod_id . '/' . $product->image, 300, 300); ?>" alt="<?php echo $product->name; ?>">
                        </a>
                            <?php if($product->percent_off != 0) { ?>
                                <span class="new">-<?php echo $product->percent_off ; ?>%</span>
                            <?php } ?>
                            <?php if($product->amount_off != 0) {  ?>
                                <span class="new"><?php echo $this->lang->line('Sale'); ?></span>
                            <?php } ?>
                        <h3 class="name"><a href="<?php echo product_url($product->prod_id, $product->name); ?>" title="<?php echo $product->name; ?>"><?php echo $product->name; ?></a></h3>
                        <?php if($product->percent_off == 0 && $product->amount_off == 0) {  ?>
                            <p class="wrap_price"> <span class="price"><?php echo $product->price; ?><span class="price_val"><?php echo $this->lang->line('AMD'); ?></span></span> </p>
                        <?php } else {?>
                            <?php if($product->percent_off != 0) { ?>
                                <p class="wrap_price">
                                    <span class="price-old"><?php echo $product->price; ?></span>
                                    <span class="price-new"><?php echo (int)$product->price - ((int)$product->price * (int)$product->percent_off/100); ?> <?php echo $this->lang->line('AMD'); ?></span>
                                </p>
                            <?php } ; ?>
                            <?php if($product->amount_off != 0) { ?>
                                <p class="wrap_price">
                                    <span class="price-old"><?php echo $product->price; ?></span>
                                    <span class="price-new"><?php echo (int)$product->price - (int)$product->amount_off ; ?> <?php echo $this->lang->line('AMD'); ?></span>
                                </p>
                            <?php } ?>
                        <?php } ?>
                        <p class="submit">
                            <input type="button" value="<?php echo $this->lang->line('Add to Cart'); ?>" class="button"  name="add-to-cart" prod-id="<?php echo $product->product_id; ?>">
                        </p>
                    </div>
                <?php } ?>

            </div>
        </div>
    </div>
    <div class="box">
        <div>
            <h1 class="title_module"><span><?php echo $this->lang->line('Latest Products'); ?></span></h1>
            <div class="box-content">
                <?php foreach ($last_products AS $product) { ?>
                    <div class="box-product box-content_latest image-product-<?php echo $product->prod_id; ?>">
                        <a class="image" href="<?php echo product_url($product->prod_id, $product->name); ?>" title="<?php echo $this->lang->line('View more'); ?>">
                            <img src="<?php echo thumbImg('images/product/' . $product->prod_id . '/' . $product->image, 300, 300); ?>" alt="<?php echo $product->name; ?>">
                        </a>
                            <?php if($product->percent_off != 0) { ; ?>
                                <span class="new">-<?php echo $product->percent_off ; ?>%</span>
                            <?php } ; ?>
                            <?php if($product->amount_off != 0) { ; ?>
                                <span class="new"><?php echo $this->lang->line('Sale'); ?></span>
                            <?php } ; ?>
                        <h3 class="name"><a href="<?php echo product_url($product->prod_id, $product->name); ?>" title="<?php echo $product->name; ?>"><?php echo $product->name; ?></a></h3>
                        <?php if($product->percent_off == 0 && $product->amount_off == 0) { ; ?>
                            <p class="wrap_price"> <span class="price"><?php echo $product->price; ?><span class="price_val"><?php echo $this->lang->line('AMD'); ?></span></span> </p>
                        <?php } else {; ?>
                            <?php if($product->percent_off != 0) { ; ?>
                                <p class="wrap_price">
                                    <span class="price-old"><?php echo $product->price; ?></span>
                                    <span class="price-new"><?php echo (int)$product->price - ((int)$product->price * (int)$product->percent_off/100); ?> <?php echo $this->lang->line('AMD'); ?></span>
                                </p>
                            <?php } ; ?>
                            <?php if($product->amount_off != 0) { ; ?>
                                <p class="wrap_price">
                                    <span class="price-old"><?php echo $product->price; ?></span>
                                    <span class="price-new"><?php echo (int)$product->price - (int)$product->amount_off ; ?><?php echo $this->lang->line('AMD'); ?></span>
                                </p>
                            <?php } ; ?>
                        <?php }; ?>
                        <p class="submit">
                            <input type="button" value="<?php echo $this->lang->line('Add to Cart'); ?>" class="button"  name="add-to-cart" prod-id="<?php echo $product->product_id; ?>">
                        </p>
                    </div>
                <?php  } ?>

            </div>
        </div>
    </div>
    <div class="clear"></div>
    <?php $this->load->view('themes/babybuy/page_parts/flexcarousel.php'); ?>
</div>







