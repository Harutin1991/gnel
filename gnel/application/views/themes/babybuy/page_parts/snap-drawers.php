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
                                <?php if($product->percent_off == 0 && $product->amount_off == 0) { ?>
                                    <p class="wrap_price"> <span class="price"><?php echo $product->price; ?><span class="price_val"><?php echo $this->lang->line('AMD'); ?></span></span> </p>
                                <?php } else {; ?>
                                    <?php if($product->percent_off != 0) {  ?>
                                        <p class="wrap_price">
                                            <span class="sale_for_table1">-<?php echo $product->percent_off ; ?>%</span>
                                            <span class="price-old"><?php echo $product->price; ?></span>
                                            <span class="price-new"><?php echo (int)$product->price - ((int)$product->price * (int)$product->percent_off/100); ?><?php echo $this->lang->line('AMD'); ?></span>
                                        </p>
                                    <?php } ; ?>
                                    <?php if($product->amount_off != 0) { ?>
                                        <p class="wrap_price">
                                            <span class="sale_for_table1"><?php echo $this->lang->line('Sale'); ?></span>
                                            <span class="price-old"><?php echo $product->price; ?></span>
                                            <span class="price-new"><?php echo (int)$product->price - (int)$product->amount_off ; ?><?php echo $this->lang->line('AMD'); ?></span>
                                        </p>
                                    <?php }?>
                                <?php }?>




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
        <div id="column-right">

<?php if("blog" === $this->router->fetch_class()) { ?>
		<div class="box">
		  <div class="box-heading"><?php echo $this->lang->line('Categories'); ?></div>
            <div class="box-content">
                <ul>
                    <?php $language = $default_language == $this->config->item('language') ? '' : $this->config->item('language').'/'; ?>
                    <?php if(!empty($blog_ccategories)) { ?>
                        <?php foreach($blog_ccategories as $category){ ?>
                            <li><a href="<?php echo   base_url().$language.'blog/category/'.$category->id.'?page=1'; ?>" class="blog_filter " <?php echo isset($old_id) && $category->id == $old_id ? 'style="cursor: default; color: #000000;"' : ''; ?> id="<?php echo $category->id; ?>"><?php echo $category->title ?></a></li>
                        <?php } ?>
                    <?php } ?>
                </ul>
            </div>
<!--		  <div class="box-content">-->
<!--			<ul>-->
<!--			  <li><a href="#">Lorem</a></li>-->
<!--			  <li><a href="#">Ipsum</a></li>-->
<!--			  <li><a href="#">Dolor Sit</a></li>-->
<!--			  <li><a href="#">Amet Lorem</a></li>-->
<!--			  <li><a href="#">Ipsum Dolor</a></li>-->
<!--			  <li class="last-item"><a href="#">Sit Amet</a></li>-->
<!--			</ul>-->
<!--		  </div>-->
		</div>
		<div class="box">
		  <div class="box-heading"><?php echo $this->lang->line('Archive'); ?></div>
            <div class="box-content archive">
                <ul>
                    <?php if(!empty($archives)) { ?>
                        <?php foreach($archives as $archive) { ?>
                            <li> <a href="<?php echo base_url().$language.'blog/archive/'.date('Y-m-d', strtotime($archive->date_created)).'?page=1'; ?>" class="blog_filter" <?php echo isset($old_id) && date('m', strtotime($archive->date_created)) == $old_id ? 'style="cursor: default; color: #000000;"' : ''; ?> date="<?php echo $archive->date_created; ?>" ><?php echo  $this->lang->line(date('F', strtotime($archive->date_created))); ?> <span> ( <?php echo $archive->count_b; ?> )</span> </a> </li>
                        <?php  } ?>
                    <?php  } ?>
                </ul>
            </div>
<!--		  <div class="box-content archive">-->
<!--			<ul>-->
<!--			  <li> <a href="blog.html">September <span>(5)</span> </a> </li>-->
<!--			  <li> <a href="blog.html">August <span>(14)</span> </a> </li>-->
<!--			  <li> <a href="blog.html">July <span>(22)</span> </a> </li>-->
<!--			  <li> <a href="blog.html">June <span>(9)</span> </a> </li>-->
<!--			  <li> <a href="blog.html">May <span>(15)</span> </a> </li>-->
<!--			  <li class="last-item"> <a href="blog.html">April <span>(10)</span> </a> </li>-->
<!--			</ul>-->
<!--		  </div>-->
		</div>
		<div class="box">
		  <div>
			<h1 class="title_module"><span><?php echo $this->lang->line('Popular'); ?></span></h1>
              <div class="box-content popular">
                  <?php if(!empty($popular)) { ?>
                      <?php foreach($popular as $news){ ?>
                          <div class="box-product"> <a class="image" href="<?php echo blognews_url($news->id, $news->title); ?>" title="View more"> <img src="<?php echo base_url().'images/blognews/'.$news->image; ?>" alt=""> </a>
                              <h3 class="name"><a href="<?php echo blognews_url($news->id, $news->title); ?>" title=""><?php echo $news->title; ?></a></h3>
                              <div>
                                  <span style="float:right;" ><?php echo $news->total_viewed; ?></span>
                                  <img src="<?php echo base_url().'images/icons/view-icon.png' ?>" style="float:right;" >
                              </div>
                              <p class="wrap_price"> <span><?php echo date('d-m-Y', strtotime($news->date_created))  ?></span> </p>
                          </div>
                      <?php } ?>
                  <?php  } ?>

              </div>
<!--			<div class="box-content popular">-->
<!--			  <div class="box-product"> <a class="image" href="product.html" title="View more"> <img src="image/example-products/big/p1.jpg" alt=""> </a>-->
<!--				<h3 class="name"><a href="product.html" title="">Lorem ipsum dolor</a></h3>-->
<!--				<p class="wrap_price"> <span>10th january 2013</span> </p>-->
<!--			  </div>-->
<!--			  <div class="box-product"> <a class="image" href="product.html" title="View more"> <img src="image/example-products/big/p2.jpg" alt=""> </a>-->
<!--				<h3 class="name"><a href="product.html" title="">Ipsum dolor sit</a></h3>-->
<!--				<p class="wrap_price"> <span>12th january 2013</span> </p>-->
<!--			  </div>-->
<!--			  <div class="box-product"> <a class="image" href="product.html" title="View more"> <img src="image/example-products/big/p3.jpg" alt=""> </a>-->
<!--				<h3 class="name"><a href="product.html" title="">Dolor sit</a></h3>-->
<!--				<p class="wrap_price"> <span>20th january 2013</span> </p>-->
<!--			  </div>-->
<!--			  <div class="box-product last-item"> <a class="image" href="product.html" title="View more"> <img src="image/example-products/big/p4.jpg" alt=""> </a>-->
<!--				<h3 class="name"><a href="product.html" title="">Lorem ipsum</a></h3>-->
<!--				<p class="wrap_price"> <span>10th february 2013</span> </p>-->
<!--			  </div>-->
<!--			</div>-->
		  </div>
		</div>

<?php } ?>

            <div class="box">
                <div class="box-heading"><?php echo $this->lang->line('Information'); ?></div>
                <div class="box-content">
                    <?php echo drawMenu($menu['Information'], array("class" => "box-category")); ?>
                </div>
            </div>
            <div class="box">
                <div class="box-heading"><?php echo $this->lang->line('Service'); ?></div>
                <div class="box-content">
                    <?php echo drawMenu($menu["Customer Service"], array("class" => "box-category")); ?>
                </div>
            </div>
            <div class="box">
                <div class="box-heading"><?php echo $this->lang->line('Extras'); ?></div>
                <div class="box-content">
                    <?php echo drawMenu($menu["Extras"], array("class" => "box-category")); ?>
                </div>
            </div>
            <div class="box">
                <div class="box-heading"><?php echo $this->lang->line('My Account'); ?></div>
                <div class="box-content">
                    <ul>
                        <li><a href=""><?php echo $this->lang->line('Login'); ?></a></li>
                        <li><a href=""><?php echo $this->lang->line('Register'); ?></a></li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>