<div id="content">

    <div class="breadcrumb"> 

		<?php echo' » &nbsp;' . $keyword; ?> 

    </div>
	<?php if (empty($found_products)) { ?>
		<h1><span class="h1-top"><?php echo $this->lang->line('Search results'); ?></span></h1>
		<div class="product-filter">
	        <div class="display">
	            <label><?php echo $this->lang->line('No product has been found'); ?></label>
	        </div>
	    </div>
	<?php } else { ?>
	    <h1><span class="h1-top"><?php echo $this->lang->line('Search results'); ?></span></h1>

	    <img class="ajax_loader" src="<?php echo base_url('images/icons/ajax-loader.gif'); ?>" />

	    <div class="product-filter">
	        <div class="display">
	            <label><?php echo $this->lang->line('Display:'); ?></label>
	            <p>
	                <span id="list" <?php echo $cat_display == 'list' ? 'class="list_on"' : ''; ?>><i class="fa fa-bars fa-fw"></i></span> 
	                <span id="grid" <?php echo $cat_display == 'grid' ? 'class="list_on"' : ''; ?>><i class="fa fa-th-large fa-fw"></i></span>
	            </p>
	        </div>


	        <div class="limit">
	            <label><?php echo $this->lang->line('Show:'); ?></label>
	            <select class="selectBox" id="perpage_select">
	                <option value="15" <?php echo $cat_perpage == '15' ? 'selected="selected"' : ''; ?>>15</option>
	                <option value="25" <?php echo $cat_perpage == '25' ? 'selected="selected"' : ''; ?>>25</option>
	                <option value="50" <?php echo $cat_perpage == '50' ? 'selected="selected"' : ''; ?>>50</option>
	            </select>
	        </div>
	    </div>
	    <div class="product-list-wrapper">
			<?php $this->load->view('product/found-product-list', $this->data); ?>
	    </div>
	<?php } ?>
</div>


<script>
	jQuery(document).ready(function($) {
		$("#list").click(function() {
			$.cookie('cat_display', 'list', {expires: 7, path: '/'});
		});
		$("#grid").click(function() {
			$.cookie('cat_display', 'grid', {expires: 7, path: '/'});
		});

		$("#brand_select").change(function() {
			$.cookie('cat_brand', $(this).val(), {expires: 1, path: '/'});
			ajax_filter(1);
		});
		$("#perpage_select").change(function() {
			$.cookie('cat_perpage', $(this).val(), {expires: 1, path: '/'});
			ajax_filter(1);
		});
		$(document).on("click", ".pagination a", function() {
			var new_page = parseInt($(this).text());
			var page_number = parseInt($('.pagination a.active').text());

			if ($(this).attr('first-page') !== undefined) {
				var new_page = 1;
			} else if ($(this).attr('last-page') !== undefined) {
				var new_page = parseInt($(this).attr('last-page'));
			} else if ($(this).attr('first') !== undefined) {
				var new_page = page_number > 1 ? page_number - 1 : 1;

			} else if ($(this).attr('last') !== undefined) {
				var last_page = parseInt($(this).attr('last'));
				var new_page = page_number == last_page ? page_number : page_number + 1;
			} else {
				var new_page = parseInt($(this).text());
			}
			if (new_page != page_number) {
				ajax_filter(new_page);
			}
			return false;
		});
		$(".pagination a").click(function() {
			var new_page = parseInt($(this).text());
			var page_number = parseInt($('.pagination a.active').text());
			if ($(this).attr('first-page') !== undefined) {
				var new_page = 1;
			} else if ($(this).attr('last-page') !== undefined) {
				var new_page = parseInt($(this).attr('last-page'));
			} else if ($(this).attr('first') !== undefined) {
				var new_page = page_number > 1 ? page_number - 1 : 1;
			} else if ($(this).attr('last') !== undefined) {
				var last_page = parseInt($(this).attr('last'));
				var new_page = page_number == last_page ? page_number : page_number + 1;
			} else {
				var new_page = parseInt($(this).text());
			}
			if (new_page != page_number) {

				ajax_filter(new_page);
			}
			return false;
		});


		function ajax_filter(cat_pagenum) {
			var cat_brand = $('#brand_select').val();
			var cat_perpage = $('#perpage_select').val();
			var keyword = '<?php echo $keyword; ?>';
			$('.ajax_loader').show();
			$.ajax({
				url: site_url + "ajax",
				dataType: 'json',
				type: 'post',
				data: {
					action: 'found_product_filter',
					keyword: keyword,
					cat_brand: cat_brand,
					cat_perpage: cat_perpage,
					cat_pagenum: cat_pagenum
				},
				success: function(data) {
					$('.product-list-wrapper').html(data.html);
					$('.ajax_loader').hide();
					setPaginationUrl(cat_pagenum, cat_perpage);
				}
			});
		}
		function setPaginationUrl(page, perpage) {
			//var newURL = window.location.protocol + '//'+ window.location.host + "/" + window.location.pathname+ '?page=' + page;
			var url = window.location.href;
			var url_ = url.split('?');
			var newURL = url_[0] + '?page=' + page + '&perpage=' + perpage;
			console.log(newURL);
			ChangeUrl('search', newURL);
		}
		function ChangeUrl(title, url) {
			if (typeof (history.pushState) != "undefined") {
				var obj = {Title: title, Url: url};
				history.pushState(obj, obj.Title, obj.Url);
			} else {
				alert("Browser does not support HTML5.");
			}
		}
	});
</script>