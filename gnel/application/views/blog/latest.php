  <?php //echo '<pre>';var_dump($default_language); ?>
  <div id="content">
<!--    <div class="breadcrumb"> <a href="--><?php //echo base_url(); ?><!--">Home</a> » <a href="--><?php //echo base_url().'blog/'; ?><!--">Blog</a></div>-->
    <h1><span class="h1-top"><?php echo $this->lang->line('Blog'); ?></span></h1>
    <div class="information_content">
	    <?php if(isset($special_news) && !empty($special_news)) { ?>
            <div first_id="<?php echo $special_news->id; ?>" class="post_item  first_post_item">


                <!--			<p class="post_info">Written by <a href="--><?php //echo base_url().'page/contact-us/'; ?><!--">Babybuy.am</a> on --><?php //echo date('F d,Y', strtotime($news->date_created)); ?><!--- 12 <a href="blog-details.html">comments</a></p>-->

                <div class="imageborder"><a href="<?php echo blognews_url($special_news->id, $special_news->title); ?>"><img alt="About" src="<?php echo base_url().'images/blognews/'.$special_news->image; ?>"></a></div>
                <div class="clear"></div>
                <h2><?php echo $special_news->title; ?></h2>
                <p class="short_content">
                    <a href="<?php echo blognews_url($special_news->id, $special_news->title); ?>">
                        <?php echo $special_news->short_content; ?>
                    </a>
                </p>
                <!--			<p class="short_content"><a href="--><?php // echo blognews_url($news->id, $news->title); ?><!--" title="Read more...">read more...</a> </p>-->
            </div>
        <?php } ?>
        <span id="scroll_to"></span>
        <?php if(!empty($blognews)) { ?>
		<?php foreach($blognews as $key=>$news) { ?>
            <?php if( $news->id != $first_item_id){ ?>
            <div class="col" id="news_<?php echo $news->total_viewed; ?>">
		        <div first_id="<?php echo $news->id; ?>" class="post_item min_post_item box-product">


<!--			<p class="post_info">Written by <a href="--><?php //echo base_url().'page/contact-us/'; ?><!--">Babybuy.am</a> on --><?php //echo date('F d,Y', strtotime($news->date_created)); ?><!--- 12 <a href="blog-details.html">comments</a></p>-->

            <div class="imageborder"><a href="<?php echo blognews_url($news->id, $news->title); ?>"><img alt="About" src="<?php echo base_url().'images/blognews/'.$news->image; ?>"></a></div>
              <h2><a href="<?php echo blognews_url($news->id, $news->title); ?>"><?php echo $news->title; ?></a></h2>
              <p class="short_content">
                  <a href="<?php echo blognews_url($news->id, $news->title); ?>">
				    <?php echo $news->short_content; ?>
                  </a>
			  </p>
                    <div class="comment_view_block">
                        <img src="<?php echo base_url().'images/icons/comment-icon.png' ?>"  >
                       <span><?php echo isset($news->ct_comments)  ? $news->ct_comments : "0"; ?>

                       </span>
                        <img class="view_icon" src="<?php echo base_url().'images/icons/view-icon.png' ?>"  >
                        <span><?php echo $news->total_viewed; ?></span>
                    </div>
<!--			<p class="short_content"><a href="--><?php // echo blognews_url($news->id, $news->title); ?><!--" title="Read more...">read more...</a> </p>-->
		  </div>
		</div>
                <?php } ?>
        <?php } ?>
	  <?php } ?>
    </div>
  </div>
  <?php if(!empty($blognews)) {

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

  <div class="pagination">
      <?php if ($page_count > 1) { ?>
          <div class="results">
              <ul class="pagination-centered">
                  <li class="first-page <?php echo 1 == $page_number ? "disabled" : ""; ?>">
                      <a  first-page="1"><?php echo $this->lang->line('First'); ?></a>
                  </li>
                  <li class="prev <?php echo 1 == $page_number ? "disabled" : ""; ?>">
                      <a  first="1">«</a>
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
                                  <a ><?php echo $i; ?></a>
                              </li>
                          <?php } ?>
                      <?php } ?>
                  <?php } ?>
                  <li class="next <?php echo $page_count == $page_number ? "disabled" : ""; ?>" >
                      <a  last="<?php echo $page_count ?>">»</a>
                  </li>
                  <li class="last-page <?php echo $page_count == $page_number ? "disabled" : ""; ?>" >
                      <a  last-page="<?php echo $page_count ?>"><?php echo $this->lang->line('Last'); ?></a>
                  </li>

              </ul>
          </div>
      <?php } ?>
  </div>
<?php } ?>
<script type="text/javascript">


jQuery(document).ready(function($) {


    $(document).on("click", ".pagination a", function() {
        document.getElementById("scroll_to").scrollIntoView();
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
            $('.active').removeClass('active');
            $(this).addClass('active');
        }
        return false;
    });
//    $(".pagination a").click(function() {
//
//        var new_page = parseInt($(this).text());
//        var page_number = parseInt($('.pagination a.active').text());
//        if ($(this).attr('first-page') !== undefined) {
//            var new_page = 1;
//        } else if ($(this).attr('last-page') !== undefined) {
//            var new_page = parseInt($(this).attr('last-page'));
//        } else if ($(this).attr('first') !== undefined) {
//            var new_page = page_number > 1 ? page_number - 1 : 1;
//        } else if ($(this).attr('last') !== undefined) {
//            var last_page = parseInt($(this).attr('last'));
//            var new_page = page_number == last_page ? page_number : page_number + 1;
//        } else {
//            var new_page = parseInt($(this).text());
//        }
//        if (new_page != page_number) {
//            ajax_filter(new_page);
//            $('.active').removeClass('active');
//            $(this).addClass('active');
//        }
//        //return false;
//    });
    function ajax_filter(blg_pagenum) {
        var url = window.location.href.split('/');
        var filter_name  = url[4] === undefined ? url[3] : url[4];
        var first_item_id = $('.first_post_item').attr('first_id');
        var filter_id = url[5] !== undefined ? url[5].split('?')[0] : null;
        console.log(blg_pagenum+','+filter_name+','+filter_id);
        $('.ajax_loader').show();
        $.ajax({
            url: site_url + "ajax",
            dataType: 'html',
            type: 'post',
            data: {
                action:       'blognews_filter',
                filter_name:  filter_name,
                blg_pagenum:  blg_pagenum,
                first_item_id: first_item_id,
                filter_id:    filter_id
            },
            success: function(data) {
//                console.log(data);
                $('#content').html('');
                $('#content').html(data);
                $('.ajax_loader').hide();
                setPaginationUrl(blg_pagenum);
            }
        });
    }
    function setPaginationUrl(page){
        //var newURL = window.location.protocol + '//'+ window.location.host + "/" + window.location.pathname+ '?page=' + page;
        var url = window.location.href;
        var url_ = url.split('?');
        var newURL = url_[0] + '?page=' + page;
        //console.log(newURL);
        ChangeUrl('pages', newURL);
    }
    function ChangeUrl(title, url) {
        if (typeof (history.pushState) != "undefined") {
            var obj = {Title: title, Url: url};
            history.pushState(obj, obj.Title, obj.Url);
        } else {
            alert("Browser does not support HTML5.");
        }
    }
	/*$(document).on("click", '.blog_filter', function(){
		//function ajax_filter() {
			var fiterl_name = $(this).attr('name') ;
			var filter_id = null;
			if(fiterl_name == 'category'){
				 filter_id = $(this).attr('id');
			
			}else if(fiterl_name == 'archive'){
				var date = $(this).attr('date').split(' ');
				filter_id = date[0];
			}
			var url = window.location.href;
            var url_ = url.split('blog');

			var newUrl = url_[0]+'blog/'+fiterl_name+'/'+filter_id;
			console.log(url_);
			ChangeUrl(fiterl_name, newUrl);
			$.ajax({
				url: site_url + "ajax",
				dataType: 'json',
				type: 'post',
				data: {
					action:       'blog_filter',
					blog_filter_id: filter_id,
					blog_filter_name:  fiterl_name
				},
				success: function(data) {
					console.log(data);
					$('.product-list-wrapper').html(data.html);
					$('.ajax_loader').hide();
					setPaginationUrl(cat_pagenum, cat_perpage, br_category);
				}
			});
		//}
		return false;
	});*/
	

});
</script>