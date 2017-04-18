<div id="content">

    <div class="breadcrumb"> 

        <?php
        $el_count = count($parent_categories_array);
        $i = 1;
        ?>
        <?php if ($el_count > 0) { ?>
            <?php foreach ($parent_categories_array AS $cat) { ?>
                <a href=""><?php echo $cat; ?></a> <?php echo $el_count != $i++ ? ' » &nbsp;' : ''; ?> 
            <?php } ?>
        <?php } ?>
    </div>

    <h1>
		<span class="h1-top"><?php // echo $c_brand['name_' . $this->config->item('language')]; ?>
			<?php $img_url = brandImg($c_brand['image']); ?>
			<img src="<?php echo thumbImg($img_url, 110, 110); ?>">
		</span>
	</h1>
    <div class="category-info">
        <div><?php echo $c_brand["description_" . $this->config->item('language')]; ?></div>
    </div>
    
    <img class="ajax_loader" src="<?php echo base_url('images/icons/ajax-loader.gif'); ?>" />
    
    <div class="product-filter">
        <div class="display">
            <label><?php echo $this->lang->line('Display:'); ?></label>
            <p>
                <span id="list" <?php echo $cat_display == 'list' ? 'class="list_on"' : ''; ?>><i class="fa fa-bars fa-fw"></i></span> 
                <span id="grid"<?php echo $cat_display == 'grid' ? 'class="list_on"' : ''; ?>><i class="fa fa-th-large fa-fw"></i></span>
            </p>
        </div>
        <div class="sort">
            <label><?php echo $this->lang->line('Categories:'); ?></label>
            <select class="selectBox" id="category_select">
                <option value="0" <?php echo $br_category == '0' ? 'selected="selected"' : ''; ?>><?php echo $this->lang->line('All'); ?></option>
                <?php if (count($brand_categories) > 0) { ?>
                    <?php foreach ($brand_categories AS $b_category) { ?>
                        <option value="<?php echo $b_category->id; ?>" <?php echo $br_category == $b_category->id ? 'selected="selected"' : ''; ?>><?php echo $b_category->name; ?></option>
                    <?php } ?>
                <?php } ?>
            </select>
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
        <?php $this->load->view('brands/product-list', $this->data); ?>
    </div>
</div>


<script>
    jQuery(document).ready(function($) {
        $("#list").click(function() {
            $.cookie('cat_display', 'list', {expires: 7, path: '/'});
        });
        $("#grid").click(function() {
            $.cookie('cat_display', 'grid', {expires: 7, path: '/'});
        });
        $("#perpage_select").change(function() {
            $.cookie('cat_perpage', $(this).val(), {expires: 1, path: '/'});
            ajax_filter(1);
        });
        $("#category_select").change(function() {
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
            var br_category = $('#category_select').val();
            var cat_perpage = $('#perpage_select').val();
            var brand_id = <?php echo $c_brand['id']; ?>;
            var c_brand_name = '<?php echo $c_brand_name; ?>';
            $('.ajax_loader').show();
            $.ajax({
                url: site_url + "ajax",
                dataType: 'json',
                type: 'post',
                data: {
                    action:       'brand_filter',
                    brand_id:     brand_id,
                    cat_perpage:  cat_perpage,
                    br_category:  br_category,
                    cat_pagenum:  cat_pagenum,
                    c_brand_name: c_brand_name
                },
                success: function(data) {
                    $('.product-list-wrapper').html(data.html);
                    $('.ajax_loader').hide();
                    setPaginationUrl(cat_pagenum, cat_perpage, br_category);
                }
            });
        }
        function setPaginationUrl(page, perpage, br_category){
            //var newURL = window.location.protocol + '//'+ window.location.host + "/" + window.location.pathname+ '?page=' + page;
            var url = window.location.href;
            var url_ = url.split('?');
            var newURL = url_[0] + '?page=' + page + '&perpage=' + perpage + '&br_category=' + br_category ;
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