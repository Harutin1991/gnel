<div id="content">
    <div class="breadcrumb"> <a href="<?php echo site_url(); ?>"><?php echo $this->lang->line('Home'); ?></a> » <?php echo $this->lang->line('Delivery'); ?> </div>
	<?php
//    echo "<pre>";
//    print_r($delivery_prices);
//    exit;
	?>
    <h1><span class="h1-top"><?php echo $this->lang->line('Delivery'); ?></span></h1>

	<h3 class="del_yer"><?php echo $this->lang->line('In Yerevan orders with amount %1 dr. and more delivery fee is free. Up to %1 dr.  delivery fee is %2 dr.', 15000, 1000); ?></h3>
	<table class="list">
		<thead>
			<tr>
				<td class="left "><?php echo $this->lang->line('City'); ?></td>
				<td class="left "><?php echo $this->lang->line('Price'); ?></td>
			</tr>
		</thead>
		<tbody>
			<?php if (isset($delivery_prices) && is_array($delivery_prices) && !empty($delivery_prices)) { ?>
				<?php foreach ($delivery_prices AS $del_pr) { ?>
					<tr>
						<td class="left "><?php echo $del_pr->name; ?></td>
						<td class="left "><?php echo $del_pr->price; ?> <span class="dram fz10"><?php echo $this->lang->line('AMD'); ?></span></td>
					</tr>
				<?php } ?>
			<?php } ?>
		</tbody>
	</table>



</div>
<script type="text/javascript">
	jQuery(document).ready(function($) {

	});
</script>