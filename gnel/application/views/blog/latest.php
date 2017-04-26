<div class="col-sm-11 container">

    <div id="content">
    <!--    <div class="breadcrumb"> <a href="--><?php //echo base_url(); ?><!--">Home</a> » <a href="--><?php //echo base_url().'blog/'; ?><!--">Blog</a></div>-->
        <h1 class="text-center"><span class="h1-top"><?php echo $this->lang->line('Blog'); ?></span></h1>
        <div class="information_content">
            <span id="scroll_to"></span>
            <?php if(!empty($blognews)) { ?>
                <?php foreach($blognews as $key => $news) { ?>
                    <div id="blog-all">
                        <div class="blog-item" data="1">
                            <div class="img-container">
                                <div class="img" style="background-image: url(<?php echo base_url().'images/blognews/'.$news->image; ?>)">

                                </div>
                            </div>
                            <div class="text-container">
<!--                                <a href="--><?php //echo blognews_url($news->id, $news->title); ?><!--">--><?php //echo $news->title; ?><!--</a>-->
                                <a href="<?php echo base_url('blog/'.$news->id); ?>"><?php echo $news->title; ?></a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
          <?php } ?>
        </div>
    </div>
</div>


<script type="text/javascript">


jQuery(document).ready(function($) {


	

});
</script>