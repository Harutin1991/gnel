 

<div id="column-right">
    <div class="box">
        <div class="box-heading"><? echo $this->lang->line('Categories'); ?></div>
        <div class="box-content">
            <?php echo drawLeftMenu($categories, $parent_categories_array, true); ?>
        </div>
    </div>
    <div class="clear"></div>
<!--    <pre>
    <?php //print_r($last_products); ?>
    </pre>-->
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
                            <p class="wrap_price"><span class="price"><?php echo $product->price; ?> <?php echo $this->lang->line('AMD'); ?> </span> </p>
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
