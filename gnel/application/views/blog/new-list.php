    <!--    <div class="breadcrumb"> <a href="--><?php //echo base_url(); ?><!--">Home</a> » <a href="--><?php //echo base_url().'blog/'; ?><!--">Blog</a></div>-->
    <h1><span class="h1-top">Blog</span></h1>
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
                <div class="col" id="news_<?php echo $key+1; ?>">
                    <div first_id="<?php echo $news->id; ?>" class="post_item min_post_item box-product">


                        <!--			<p class="post_info">Written by <a href="--><?php //echo base_url().'page/contact-us/'; ?><!--">Babybuy.am</a> on --><?php //echo date('F d,Y', strtotime($news->date_created)); ?><!--- 12 <a href="blog-details.html">comments</a></p>-->

                        <div class="imageborder"><a href="<?php echo blognews_url($news->id, $news->title); ?>"><img alt="About" src="<?php echo base_url().'images/blognews/'.$news->image; ?>"></a></div>
                        <h2><?php echo $news->title; ?></h2>
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
