

<div id="info">
<!--    <div class="breadcrumb"><a href="--><?php //echo site_url(); ?><!--">--><?php //echo $this->lang->line('Home'); ?><!--</a> » --><?php //echo $pages->title; ?><!--</div>-->

    <div class="row">
        <h1 class="text-center"><?php echo $pages->title; ?></h1>

        <?php if(!empty($page_childes)) { ?>
            <?php foreach($page_childes as $item) { ?>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="col-parent" data="center">
                        <div class="text-container">
                            <h2 class="text-center no-margin">
<!--                                <a href="--><?php //echo site_url(). $pages->title ."/".$item->title; ?><!--">--><?php //echo $item->title; ?><!--</a>-->
                                <a href="<?php echo site_url() . "page/" . $item->title; ?>"><?php echo $item->title; ?></a>

                            </h2>
                            <p></p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            <?php } ?>
        <?php } ?>
    </div>


</div>
