<?php drawTopMenu($categories, true); ?>


<?php function drawTopMenu($categories, $f = false) { ?>
    <ul <?php echo $f ? 'class="sf-menu" id="tfc-menu"' : ''; ?>>
        <?php foreach ($categories AS $category) { ?>
            <li>
                <?php //if(!$f) var_dump($category); ?>
				<?php if($category->product_count > 0) { ?>
					<?php if (isset($category->children)) { ?>
				<a href="#" <?php echo $f ? '' : 'class="top_arrow"';?>><?php echo $category->name; ?></a>
						<?php drawTopMenu($category->children); ?>
					<?php } else { ?>
							<a href="<?php echo category_url($category->id, $category->name); ?>"><?php echo $category->name; ?> (<?php echo $category->product_count; ?>)</a>
					<?php } ?>
                <?php } ?>
            </li>
        <?php } ?>
      <!--  <li class="blogin_menu">
           <a href="#"> Բլոգ</a>
        </li>-->
    </ul>
<?php } ?>

