
<?php if (count($product_comments['comments']) > 0) { ?>
	<?php foreach ($product_comments['comments'] AS $comment) { ?>
		<div class="review-list">
			<?php $time = strtotime($comment->comment_date); ?>
			<div class="user_img">
				<?php $url = userImg($comment->user_id, $comment->user_image); ?>
				<img src="<?php echo thumbImg($url, 50, 50) ?>" />
			</div>
			<div class="author">
                <?php $user_rate = $comment->user_rate == NULL ? 0 : $comment->user_rate; ?>
				<p> <b><?php echo $comment->first_name . ' ' . $comment->last_name; ?></b>  <span> <?php echo date("d-m-Y", $time); ?></span></p>
				<div class="rating"><img <?php echo (isset($user_id) && $comment->user_id == $user_id) ? 'commented_user="me"' : ""; ?>  src="<?php echo base_url('images/icons/stars/stars-' . $user_rate . '.png'); ?>" alt="<?php echo $user_rate; ?>" reviews"></div>
				<div class="text"><?php echo $comment->comment; ?></div>
			</div>
		</div>
	<?php } ?>
<?php } ?>



<!-- Pagination START -->
<?php
// get show page range
$show_pages = array();
$show_page_count = $comment_perpage;
$page_number = $comment_page_number;
$page_count = ceil($product_comments['total'] / $show_page_count);
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