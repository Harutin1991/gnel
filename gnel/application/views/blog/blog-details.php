<div id="content">
    <?php //echo '<pre>';var_dump($news_this_categoreis); ?>
    <div class="breadcrumb"> <a href="<?php echo base_url(); ?>">Home</a> » <a href="<?php echo base_url().'blog/'; ?>">Blog</a> » <span><?php echo $news->title; ?></span></div>
<!--    <h1><span class="h1-top">Things for Cuties - the Blog</span></h1>-->
    <div class="information_content">
        <?php if(!empty($news)) : ?>
        <div class="post_item simple_post_item" blognews-id="<?php echo $news->id; ?>">
            <h2><?php echo $news->title; ?></h2>
            <p class="post_info "> <?php echo date('d/m/Y', strtotime($news->date_created)); ?> </p>
            <div class="imageborder"><img alt="news" src="<?php echo base_url().'images/blognews/'.$news->image; ?>" ></div>
            <!--<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
            <p> Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse.</p>
           -->
            <div class="clear"></div>
            <p><?php echo $news->content; ?></p>
<!--            <div class="links-share"> <span class="share-pre">Share:</span>-->
<!--                <a href="http://www.facebook.com/sharer.php?u=--><?php // echo base_url().'blognews/'.$news->id; //blognews_url($news->id, 'blognews'); ?><!--" target="_blank" ><span class="icon"><i class="fa fa-facebook fa-fw"></i></span></a>-->
<!--                <a href="http://twitter.com/share?url=--><?php // echo blognews_url($news->id, $news->title); ?><!--" target="_blank" ><span class="icon" ><i class="fa fa-twitter fa-fw"></i></span></a>-->
<!--                <a href="https://plusone.google.com/_/+1/confirm?hl=en&amp;url=--><?php //echo blognews_url($news->id, $news->title); ?><!--" target="_blank"><span class="icon"><i class="fa fa-google-plus fa-fw"></i></span></a>-->
<!--            </div>-->
        </div>
        <div class="clear"></div>
<!--        <div class="post_item commentsblock">-->
<!--            <h2>Comments (--><?php //echo  $blognews_comments['total']; ?><!--)</h2>-->
<!--            <div id="review">-->
<!--             --><?php //$this->load->view('blog/comment-list', $this->data); ?>
<!--            </div>-->
<!--        </div>-->



        <?php endif; ?>
    </div>
</div>
<script  type="text/javascript">


    jQuery(document).ready(function() {

        $("#button-review").click(function () {
            var txt = $.trim($('textarea[name=comment]').val());
            if (!txt) {
                $('.notify-empty').text('<?php echo $this->lang->line('Please fill all fields'); ?>');
                return false;
            }

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
       /* $(document).on("click", ".pagination a", function() {
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
        });*/


        function ajax_filter(pagenum) {
            var blognews_id = $('.post_item').attr('blognews-id');
            //console.log(blognews_id+','+pagenum);
            $('.ajax_loader').show();
            $.ajax({
                url: site_url + "ajax",
                dataType: 'html',
                type: 'post',
                data: {
                    action: 'blognews_comment_filter',
                    blognews_id: blognews_id,
                    pagenum: pagenum
                },
                success: function(data) {
                    $('#review').html(data);
                    $('.ajax_loader').hide();
                }
            });
        }

    });
</script>