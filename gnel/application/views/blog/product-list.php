<div class="product-<?php echo $cat_display == 'list' ? 'list' : 'grid'; ?>">
	<?php
	$c_prod = count($brand_products);
	$i = 1;
	?>
	<?php if ($c_prod > 0) { ?>
		<?php foreach ($brand_products AS $product) { ?>
			<?php $img_url = prodImg($product->product_id, $product->image); ?>
			<div class="box-product <?php echo $c_prod == $i ? 'last-item' : ''; ?> <?php echo ($i++) % 3 == 1 ? ' row-first' : ''; ?> image-product-<?php echo $product->product_id; ?>"> 
                <a class="image" href="<?php echo product_url($product->product_id, $product->name); ?>" title="<?php echo $product->name; ?>"> <img src="<?php echo thumbImg($img_url, 300, 300); ?>" alt=""> </a>
				<div class="list_grid_right">

					<h3 class="name"><a href="<?php echo product_url($product->product_id, $product->name); ?>" title=""><?php echo $product->name; ?></a></h3>
					<div><span class="price-tax"><?php echo $c_brand_name; ?></span> </div>
					<p class="wrap_price"> 
						<span class="price-new"><?php echo $product->price; ?> <?php echo $this->lang->line('AMD'); ?></span> 

					</p>
					<div class="description"><?php echo $product->description; ?></div>
					<p class="submit">
						<input type="button" value="<?php echo $this->lang->line('Add to Cart'); ?>" class="button"  name="add-to-cart" prod-id="<?php echo $product->product_id; ?>">
					</p>
					<!--<p class="links_add"> <a>Add to Wish List</a> <a>Add to Compare</a> </p>-->
				</div>
			</div>
		<?php } ?>  
	<?php } ?>  

</div>




<!-- Pagination START -->
<?php
// get show page range
$show_pages = array();
$show_page_count = 10;
if ($show_page_count > $page_count) {
	$min_page_number = 1;
	$max_page_number = $page_count;
} else {
	if ($page_number > $show_page_count / 2) {
		if ($show_page_count / 2 + $page_number <= $page_count) {
			$min_page_number = $page_number - $show_page_count / 2;
			$max_page_number = $min_page_number + $show_page_count;
		} else {
			$min_page_number = $page_count - $show_page_count;
			$max_page_number = $page_count;
		}
	} else {
		$min_page_number = 1;
		$max_page_number = $min_page_number + $show_page_count;
	}
}
?>
<!--
<div class="pagination">
    <div class="results">Showing <?php echo $page_number; ?>  to <?php echo $max_page_number; ?> of <?php echo $min_page_number; ?> </div>
</div>
-->
<div class="pagination">
	<?php if ($page_count > 1) { ?>
		<div class="results">
			<ul class="pagination-centered">
				<li class="first-page <?php echo 1 == $page_number ? "disabled" : ""; ?>">
					<a href="" first-page="1"><?php echo $this->lang->line('First'); ?></a>
				</li>
				<li class="prev <?php echo 1 == $page_number ? "disabled" : ""; ?>">
					<a href="" first="1">«</a>
				</li>
				<?php for ($i = 1; $i <= $page_count; $i++) { ?>
					<?php if ($min_page_number <= $i && $i <= $max_page_number) { ?>
						<?php if ($page_number == $i) { ?>
							<li >
								<a class="active">
									<?php echo $i; ?>
								</a>
							</li>
						<?php } else { ?>
							<li>
								<a href=""><?php echo $i; ?></a>
							</li>
						<?php } ?>
					<?php } ?>
				<?php } ?>
				<li class="next <?php echo $page_count == $page_number ? "disabled" : ""; ?>" >
					<a href="" last="<?php echo $page_count ?>">»</a>
				</li>
				<li class="last-page <?php echo $page_count == $page_number ? "disabled" : ""; ?>" >
					<a href="" last-page="<?php echo $page_count ?>"><?php echo $this->lang->line('Last'); ?></a>
				</li>

			</ul>
		</div>
	<?php } ?>
</div>
<!-- Pagination END -->