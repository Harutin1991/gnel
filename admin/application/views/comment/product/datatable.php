<div class="box-content">
    <table class="table table-striped table-bordered bootstrap-datatable responsive">
        <?php if (count($products) > 0): ?>
            <thead>
                <tr>
                    <th style="width:10%;">
                        <?php echo $this->lang->line('Image'); ?>
                    </th>
                    <th>
                        <?php echo $this->lang->line('Name'); ?>
                    </th>
                    <th class="center">
                        <?php echo $this->lang->line('Code'); ?>
                    </th>
					<th class="center">
                        <?php echo $this->lang->line('Brand'); ?>
                    </th>
                    <th class="center">
                        <?php echo $this->lang->line('Pending'); ?>
                    </th>
                    <th class="center">
                        <?php echo $this->lang->line('All Comments'); ?>
                    </th>
                    <th class="center">
                        <?php echo $this->lang->line('Actions'); ?>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php if (is_array($products) && count($products) > 0) { 
                     foreach ($products as $item) { ?>
							<tr id="tr_<?php echo $item->id; ?>">
								<td class="image-in-list">
									<?php $img_url = $item->image != '' ? $this->config->item('frontend_url') . 'images/product/' . $item->id . '/' . $item->image : base_url('img/NoPicture.jpg'); ?>
									<?php $img_url = thumbImg($img_url); ?>
									<a href="<?php echo product_url($item->id, $item->name); ?>"><img src="<?php echo $img_url; ?>"/><a/>
								</td>
								<td>
									<?php echo $item->name; ?>
								</td>
								<td  class="right">
									<?php echo $item->code; ?>
								</td>
								<td  class="center">
									<?php echo $item->brand_name; ?>
								</td>
								<td class="center red">
                                    <?php echo $product_comments_counts[$item->id]['pending_comments']; ?>
								</td>
								<td class="center">
                                    <?php echo $product_comments_counts[$item->id]['all_comments']; ?>
								</td>
								<td class="center">
									<a class="btn btn-info" href="<?php echo base_url("product/comments/" . $item->id); ?>" >
										<i class="glyphicon glyphicon-edit icon-white"></i>
									</a>
								</td>
							</tr>
                    <?php } ?>
                <?php } ?>
            </tbody>
        <?php else: ?>
            <tr>
                <td>
                    <?php echo $this->lang->line('No items to show.'); ?>
                </td>
            </tr>
        <?php endif; ?>
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
