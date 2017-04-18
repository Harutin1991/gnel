<div id="content">
    <div class="breadcrumb"> <a href="<?php echo site_url(); ?>"><?php echo $this->lang->line('Home'); ?></a> » <?php echo $this->lang->line('Partners'); ?> </div>
	<?php
//    echo "<pre>";
//    print_r($partners);
//    exit;
	?>
    <h1><span class="h1-top part_h1"><?php echo $this->lang->line('Our Partners'); ?></span></h1>

	<div class="product-list-wrapper">
		<div class="product-list">
			<?php foreach ($partners AS $partner) { ?>

				<div class="box-product partners_list">

					<a class='image' href="<?php echo $partner->link != '' ? $partner->link : '#'; ?>">
						<img src="<?php echo partnerImg($partner->image); ?>" />
					</a>


					<div class="list_grid_right">
						<h3 class="name partners_name">
							<a  href="<?php echo $partner->link != '' ? $partner->link : '#'; ?>">
								<?php echo $partner->name; ?>
							</a>
						</h3>
						<?php echo $partner->description; ?>
					</div>


				</div>

			<?php } ?>

		</div>
	</div>


</div>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$('.partner_description').hover(function() {
			$(this).children('.partner-description').show();
		}, function() {
			$(this).children('.partner-description').hide();
		});
	});
</script>