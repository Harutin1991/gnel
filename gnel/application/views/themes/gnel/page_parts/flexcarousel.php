<div class="flexcarousel" data-snap-ignore="true">
    <ul class="slides">
        <?php if (count($brands) > 0) { ?>
            <?php foreach($brands AS $brand) { ?>
                <?php $img_url = brandImg($brand->image); ?>
                <li><a href="<?php echo brand_url($brand->id, $brand->name); ?>"><img src="<?php echo thumbImg($img_url, 110, 110); ?>" alt="<?php echo $brand->name; ?>" title="<?php echo $brand->name; ?>"></a></li>
            <?php } ?>
        <?php } ?>
    </ul>
</div>