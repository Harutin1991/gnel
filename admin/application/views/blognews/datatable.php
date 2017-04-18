<div class="box-content">
   <table class="table table-striped table-bordered bootstrap-datatable responsive">
		<?php if (!empty($blognews)) { ?>
			<thead>
				<tr>
					<th style="width:10%;">
						<?php echo $this->lang->line('Image'); ?>
					</th>
					<th>
						<?php echo $this->lang->line('Title'); ?>
					</th>
					<th>
						<?php echo $this->lang->line('Short Content'); ?>
					</th>
					<th class="center">
						<?php echo $this->lang->line('Status'); ?>
					</th>
					<?php if ($this->session->userdata('admin_id') == '1') { ?>
						<th class="center">
							<?php echo $this->lang->line('Special'); ?>
						</th>
					<?php } ?>
					<th style="width:30%;" class="center">
						<?php echo $this->lang->line('Actions'); ?>
					</th>
				</tr>
			</thead>
			<tbody>
				<?php if (!empty($blognews)) { ?>
					<?php foreach ($blognews as $item) { ?>
					
						<tr id="td<?php echo $item->id; ?>">
							<td class="image-in-list">
								<?php $img_url = $item->image != '' ? $this->config->item('frontend_url') . 'images/blognews/' . $item->image : base_url('img/NoPicture.jpg'); ?>
								<img src="<?php echo $img_url; ?>"/>
							</td>
							<td>
								<?php echo $item->title; ?>
							</td>
							<td>
								<?php echo $item->short_content; ?>
							</td>
							<td class="center">
								<?php // echo $item->status; ?>
								<?php if ($item->status == "1") { ?>
									<span class="label-success label label-default" action="disable" id="<?php echo $item->id; ?>" status="change" title="<?php echo $this->lang->line('Press to ban'); ?>" style="cursor: pointer;"><?php echo $this->lang->line('Active'); ?></span>
								<?php } else { ?>
									<span class="label-default label label-danger"  action="enable" id="<?php echo $item->id; ?>" status="change" title="<?php echo $this->lang->line('Press to activate'); ?>" style="cursor: pointer;"><?php echo $this->lang->line('Banned'); ?></span>
								<?php } ?>
							</td>
							<?php if ($this->session->userdata('admin_id') == '1') { ?>
								<td class="center">
									<a href="#" class="special" special="<?php echo  $item->special; ?>" action="<?php //echo $item->special == "1" ? "make_ordinary_product" : "make_special_product"; ?>" id="<?php echo $item->id; ?>">
										<?php echo $item->special; ?>
									</a>
								</td>
							<?php } ?>
							<td class="center">
								<a class="btn btn-info" href="<?php echo base_url("blognews/edit/" . $item->id); ?>" >
									<i class="glyphicon glyphicon-edit icon-white"></i>
									<?php // echo $this->lang->line('Edit'); ?>
								</a>
                                <a class="btn btn-danger delete" alt="<?php echo $item->id; ?>" >
                                    <i class="glyphicon glyphicon-trash icon-white"></i>
                                </a>
							</td>
						</tr>
					<?php } ?>
				<?php } ?>
			</tbody>
		<?php } else { ?>
			<tr>
				<td>
					<?php echo $this->lang->line('No items to show.'); ?>
				</td>
			</tr>
		<?php } ?>
	</table>
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

<?php if ($page_count > 1) { ?>
    <div class="results">
        <ul class="pagination pagination-centered">
            <li class="first-page <?php echo 1 == $page_number ? "disabled" : ""; ?>">
                <a href="" first-page="1"><?php echo $this->lang->line('First'); ?></a>
            </li>
            <li class="prev <?php echo 1 == $page_number ? "disabled" : ""; ?>">
                <a href="" first="1">«</a>
            </li>
            <?php for ($i = 1; $i <= $page_count; $i++) { ?>
                <?php if ($min_page_number <= $i && $i <= $max_page_number) { ?>
                    <?php if ($page_number == $i) { ?>
                        <li class="disabled">
                            <a href=""><?php echo $i; ?></a>
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

<script>
    $('.delete').click(function() {
        var id = $(this).attr('alt');
        console.log(base_url);

        $.msgBox({
            title: '<?php echo $this->lang->line('Delete'); ?>',
            content: '<?php echo $this->lang->line('Are you sure you want to delete language?'); ?>',
            type: "error",
            buttons: [{value: '<?php echo $this->lang->line('Yes'); ?>'}, {value: '<?php echo $this->lang->line('No'); ?>'}],
            success: function(result) {
                if (result == '<?php echo $this->lang->line('Yes'); ?>') {
                    $.ajax({
                        url: base_url + "ajax",
                        dataType: 'json',
                        type: 'post',
                        data: {'action': 'delete_blog', 'id': id},
                        success: function(data) {
                            if (data.success == true)
                                $('#td' + id).fadeOut(2000, function() {
                                    $(this).remove();
                                });
                        }
                    });
                }
                else if (result == '<?php echo $this->lang->line('No'); ?>') {
                    //    alert('Ոչ');
                }
            }
        });
    });

</script>
