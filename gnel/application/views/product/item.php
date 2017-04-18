
<div id="content">
    <script  type="text/javascript">
//	jQuery(document).ready(function() {
        (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id))
            return;
        js = d.createElement(s);
        js.id = id;
        //js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3";
        js.src = "//connect.facebook.net/" + "<?php echo $this->lang->line('en_US'); ?>" + "/sdk.js#xfbml=1&version=v2.3";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
//    });

    </script>
    <div class="breadcrumb"> 

		<?php
		$el_count = count($parent_categories_array);
		$i = 1;
		?>
		<?php if ($el_count > 0) { ?>
			<?php foreach ($parent_categories_array AS $category) { ?>
				<a href=""><?php echo $category; ?></a> <?php echo $el_count != $i++ ? ' » ' : ''; ?> 
			<?php } ?>
		<?php } ?>
    </div>
    <h1 class="prod_name_size"><span class="h1-top"> <?php echo $product["name_" . $this->config->item('language')]; ?>  <?php echo $product["brand_name"]; ?> </span></h1>
    <div class="product-info">
        <div class="left">
            <div class="image image-product-<?php echo $product['id']; ?>" data-snap-ignore="true" >
				<?php $img_url = base_url('images/product/' . $product['id'] . '/' . $product['image']); ?>
                <a href="<?php echo $img_url; ?>" title="" class="cloud-zoom" id='zoom1' rel="adjustX: 0, adjustY:0" data-snap-ignore="true">
                    <img src="<?php echo $img_url; ?>" title="" alt="" id="image" />
                 </a>
                <div class="zoom">
                    <a id="zoomer" rel="0815" class="colorbox" href="<?php echo $img_url; ?>">
                        <i class="fa fa-search fa-fw"></i>&nbsp;<?php echo $this->lang->line('Zoom'); ?></a>
                </div>
            </div>
            <div class="image-additional">
                <div class="productcaroussel" data-snap-ignore="true">
                    <ul class="slides">
						<?php foreach ($product_images AS $pr_image) { ?>
							<li>
								<?php $img_url = prodImg($product['id'], $pr_image->image); ?>
								<a href="<?php echo $img_url; ?>" title="" class="cloud-zoom-gallery" rel="useZoom: 'zoom1', smallImage: '<?php echo $img_url; ?>' ">
									<img src="<?php echo thumbImg($img_url); ?>" title="<?php echo $product["name_" . $this->config->item('language')]; ?>" alt="<?php echo $product["name_" . $this->config->item('language')]; ?>" />
								</a>
							</li>


						<?php } ?>

                    </ul>
                </div>

            </div>

        </div>
        <div class="right">
            <div class="description">
                <div class="price"> <span id="line_s"></span>
					<?php if($product["percent_off"] == 0 && $product["amount_off"] == 0) { ; ?>
						<p class="wrap_price"><span class="price-new"><?php echo $product["price"]; ?> <span class="dram"><?php echo $this->lang->line('AMD'); ?></span></span> </p>
<!--						<p class="wrap_price"> <span class="price">--><?php //echo $product->price; ?><!--<span class="price_val">--><?php //echo $this->lang->line('AMD'); ?><!--</span></span> </p>-->
					<?php } else {; ?>
						<?php if($product["percent_off"] != 0) { ; ?>
							<p class="wrap_price">
								<span class="price-old"><?php echo $product["price"]; ?></span>
								<span class="price-new"><?php echo (int)$product["price"] - ((int)$product["price"] * (int)$product["percent_off"]/100); ?><?php echo $this->lang->line('AMD'); ?></span>
								<p><span class="price-tax"><?php echo $this->lang->line('Sale'); ?>: -<?php echo $product["percent_off"]; ?>%</span></p>
							</p>
						<?php } ; ?>
						<?php if($product["amount_off"] != 0) { ; ?>
							<p class="wrap_price">
								<span class="price-old"><?php echo $product["price"]; ?></span>
								<span class="price-new"><?php echo (int)$product["price"] - (int)$product["amount_off"] ; ?><?php echo $this->lang->line('AMD'); ?></span>
								<p><span class="price-tax"><?php echo $this->lang->line('Sale'); ?>: -<?php echo $product["amount_off"]; ?><?php echo $this->lang->line('AMD'); ?></span></p>
							</p>
						<?php } ; ?>
					<?php }; ?>
                </div>
<!--				<div class="fb-share-button" data-href="--><?php //echo product_url($product['id'], $product["name_" . $this->config->item('language')]) ?><!--" data-layout="button_count"></div>-->
            </div>
            <div class="desc2"> <span><?php echo $this->lang->line('Brand:'); ?></span>
                <a href="<?php echo brand_url($product['brand_id'], $product['brand_name']); ?>"><?php echo $product['brand_name']; ?></a><br>
                <span><?php echo $this->lang->line('Product Code:'); ?></span> <?php echo $product["code"]; ?><br>
                <!--<span>Availability:</span> In Stock--> 
            </div>
            <div class="cart">
                <div>
                    <span class="qtty"><?php echo $this->lang->line('Qty:'); ?></span>
                    <span class="qtyinput"><input type="text" name="prod-qty" size="2" value="1"></span>
                    &nbsp;
                    <span class="cartbtn"><input type="button" value="<?php echo $this->lang->line('Add to Cart'); ?>" id="button-cart" class="button" name="add-to-cart" prod-id="<?php echo $product['id']; ?>"></span>
                </div>
            </div>
            <div class="review">
                <div class="rate_stars"><img src="<?php echo base_url('images/icons/stars/stars-' . round($product_rates['avg_rate']) . '.png'); ?>" alt="0 reviews"></div>
                <div class="rate_text"><?php echo $this->lang->line('Voters:'); ?><span class="voters_count"><?php echo $product_rates['voters_count']; ?></span>,&nbsp; <?php echo $this->lang->line('Average rate:'); ?> <span class="avg_rate"><?php echo round($product_rates['avg_rate'], 2); ?></span></div>
                <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
				<?php if (isset($logged) && $logged) { ?>
					<div class="rating_radio" >
						<b><?php echo $this->lang->line('Rating:'); ?></b> <span><?php echo $this->lang->line('Bad'); ?></span>&nbsp;
						<input type="radio" name="rating" value="1" id="rating1" <?php echo 1 == $user_product_rate ? 'checked="checked"' : ''; ?>>
						&nbsp;
						<input type="radio" name="rating" value="2" id="rating2" <?php echo 2 == $user_product_rate ? 'checked="checked"' : ''; ?>>
						&nbsp;
						<input type="radio" name="rating" value="3" id="rating3" <?php echo 3 == $user_product_rate ? 'checked="checked"' : ''; ?>>
						&nbsp;
						<input type="radio" name="rating" value="4" id="rating4" <?php echo 4 == $user_product_rate ? 'checked="checked"' : ''; ?>>
						&nbsp;
						<input type="radio" name="rating" value="5" id="rating5" <?php echo 5 == $user_product_rate ? 'checked="checked"' : ''; ?>>
						&nbsp;<span><?php echo $this->lang->line('Good'); ?></span><br>

					</div>
				<?php } else { ?>
					<div><?php echo $this->lang->line('Please'); ?> <a href="<?php echo site_url('account/login'); ?>"> <?php echo $this->lang->line('login'); ?></a> <?php echo $this->lang->line('to vote'); ?> </div>
				<?php } ?>
                <br>


                <div id="view_comment_link"><input type="button" value="<?php echo $this->lang->line('Vote'); ?>" id="button-vote" class="button">&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#review-title"><?php echo $this->lang->line('Write a review'); ?> </a></div>
                <div class="share"><!-- Go to www.addthis.com/dashboard to customize your tools -->
                    <div class="addthis_sharing_toolbox">

					</div>
                        
                </div>
            </div>
			<div class="links-share"> <span class="share-pre"></span>
				<a href="http://www.facebook.com/sharer.php?u=<?php echo base_url().'product/'.$product['id']; //product_url($product['id'], $product['name']); ?>" target="_blank"><span class="icon"><i class="fa fa-facebook fa-fw"></i></span></a>
				<a href="http://twitter.com/share?url=<?php echo product_url($product['id'], $product['name']);  ?>" target="_blank" ><span class="icon"><i class="fa fa-twitter fa-fw"></i></span></a>
				<a href="https://plusone.google.com/_/+1/confirm?hl=en&amp;url=<?php echo product_url($product['id'], $product['name']); ?>" target="_blank"><span class="icon"><i class="fa fa-google-plus fa-fw"></i></span></a>
				<!--   <a href="mailto:?subject=I wanted you to see this site&amp;body=Check out this site http://www.website.com"><span class="icon"><i class="fa fa-envelope fa-fw"></i></span></a> -->
			</div>
            
<!--            <div class="page-like-wrapper">
                 FB page likes 
                <div class="fb-page" data-href="https://www.facebook.com/babybuy.am" data-small-header="true" data-adapt-container-width="false" data-hide-cover="true" data-show-facepile="false" data-show-posts="false">
                    <div class="fb-xfbml-parse-ignore">
                        <blockquote cite="https://www.facebook.com/babybuy.am">
                            <a href="https://www.facebook.com/babybuy.am">Babybuy.am</a>
                        </blockquote>
                    </div>
                </div>
                 <div class="fb-like-box" data-href="https://www.facebook.com/pages/babybuyam/343918929043210?ref=hl" data-width="220" data-height="250" data-show-faces="false" data-stream="false" data-show-border="false" data-header="false"></div>
                 FB page likes 
            </div>-->
        </div>
    </div>
    <div id="tabs" class="htabs">
        <a href="#tab-description"><?php echo $this->lang->line('Description'); ?></a>
		<?php if (!empty($product_options)) { ?>
        <a href="#tab-specification"><?php echo $this->lang->line('Specifications'); ?></a>
		<?php } ?>
        <a href="#tab-review" ><?php echo $this->lang->line('Reviews'); ?> (<?php echo $product_comments['total']; ?>)</a>
		<?php if($product["youtube_link"] !="") { ?>
		<a href="#tab-video" ><?php echo $this->lang->line('Video'); ?> </a>
		<?php } ?>
    </div>
    <h1 class="h1-accordeon"><i class="fa fa-plus fa-fw"></i>&nbsp;<?php echo $this->lang->line('Description'); ?></h1>
    <div id="tab-description" class="tab-content tc-first">
        <div class="cpt_product_description ">
            <div>
				<?php echo $product["description_" . $this->config->item('language')]; ?>
            </div>
        </div>
    </div>
    <?php if (!empty($product_options)) { ?>
    <h1 class="h1-accordeon"><i class="fa fa-plus fa-fw"></i>&nbsp;<?php echo $this->lang->line('Specifications'); ?></h1>
    <div id="tab-specification" class="tab-content">
        <div class="cpt_product_description ">
            <div>
				<?php if (!empty($product_options)) { ?>
					<div class="custom_table">
						<?php foreach ($product_options AS $option) { ?>
							<div class="custom_tr">
								<div class="custom_td"><?php echo $option->name . $this->lang->line(':') . '</div> <div class="custom_td">' . $option->val; ?></div>
							</div>
						<?php } ?>
					</div>
				<?php } ?>

            </div>
        </div>
    </div>
    <?php } ?>
    <h1 class="h1-accordeon"><i class="fa fa-plus fa-fw"></i>&nbsp;<?php echo $this->lang->line('Reviews'); ?> (<?php echo $product_comments['total']; ?>)</h1>
    <div id="tab-review" class="tab-content" >
        <div id="review">
			<?php $this->load->view('product/comment-list', $this->data); ?>
        </div>
		<?php if (isset($success) && $success) { ?>
			<!--			<div class="success-add-comment">Your comment added successfully.</div>-->
		<?php } ?>
        <div class="review-form-wrapper">
            <form action="#review"   method="post">
                <h2 id="review-title"><?php echo $this->lang->line('Write a review'); ?>
<!--                    --><?php ////if(isset($_GET['dev'])) { ?>
<!--                        <br/><span class="review-supplement">--><?php //echo $this->lang->line('If you have a questions about this product, write your questions and the representative of') . $product["brand_name"] . $this->lang->line('will answer your questions.'); ?><!--</span>-->
<!--                    --><?php ////} ?>
                </h2>
                
                <b><?php echo $this->lang->line('Your Name:'); ?></b><br>
                <input  type="text" name="commentator_name" value="<?php echo $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name'); ?>" disabled="disabled">
                <br>
                <br>
                <b><?php echo $this->lang->line('Your Review:'); ?></b>
                <textarea  name="comment" cols="40" rows="8" style="width: 98%; color: red;"  maxlength="2000" <?php echo (isset($logged) && $logged) ? '' : 'disabled="disabled"'; ?> ><?php echo (isset($logged) && $logged) ? '' : $this->lang->line("Please") . " " . $this->lang->line('login') . ' ' . $this->lang->line('to comment'); ?></textarea>
                <!--<span style="font-size: 11px;"><span style="color: #FF0000;">Note:</span> HTML is not translated!</span><br>-->
                <br>

                <div class="buttons">
                    <!--<div class="right"><a id="button-review" class="button">Submit</a></div>-->
                    <div class="right">
						<?php if (isset($logged) && $logged) { ?>
							<input type="submit" value="<?php echo $this->lang->line('Comment'); ?>" name="submit_comment"  id="button-review"  class="button"  <?php echo (isset($logged) && $logged) ? '' : 'disabled="disabled"'; ?>/>
						<?php } else { ?>
							<div> <?php echo $this->lang->line('Please'); ?> <a href="<?php echo site_url('account/login'); ?>"><?php echo $this->lang->line('login'); ?> </a> <?php echo $this->lang->line('to comment'); ?></div>
						<?php } ?>
                    </div>
                    <div class="notify-empty "><?php echo isset($error) ? $error : ''; ?></div>
                </div>
            </form>
        </div>
        <div class="clear"></div>
    </div>
	
	<?php if($product["youtube_link"] !="") { ?>

	<h1 class="h1-accordeon"><i class="fa fa-plus fa-fw"></i>&nbsp;<?php echo $this->lang->line('Video'); ?></h1>
    <div id="tab-video" class="tab-content tc-first">
        <div class="cpt_product_video ">
            <div class="videoWrapper">						
				<?php $youtube = explode("v=", $product["youtube_link"]);?>
				<iframe width="560" height="349" src="https://www.youtube.com/embed/<?php echo $youtube[1];  ?>" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>
    </div>
	<?php } ?>
    <div class="clear"></div>
</div>
<div id="fb-root"></div>
<script  type="text/javascript">


	jQuery(document).ready(function() {

		$("#button-review").click(function() {
			var txt = $.trim($('textarea[name=comment]').val());
			if (!txt) {
				$('.notify-empty').text('<?php echo $this->lang->line('Please fill all fields'); ?>');
				return false;
			}

		});

<?php if (isset($success) && $success) { ?>
			setTimeout(function() {
				$('a[href=#tab-review]').click();
			}, 500)
<?php } ?>

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


		function ajax_filter(pagenum) {
			var product_id = $('input[name=product_id]').val();
			$('.ajax_loader').show();
			$.ajax({
				url: site_url + "ajax",
				dataType: 'json',
				type: 'post',
				data: {
					action: 'comment_filter',
					product_id: product_id,
					pagenum: pagenum
				},
				success: function(data) {
					$('#review').html(data.html);
					$('.ajax_loader').hide();
				}
			});
		}
		
		

		
		
	});
</script>